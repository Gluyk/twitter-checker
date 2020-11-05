<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Setting;
use App\Entity\FilterList;
use App\Entity\TwitterContent;
use App\Entity\TwitterMaxId;

class TwitterService
{

    private EntityManagerInterface $em;
    private HttpClientInterface $client;
    private string $bearerToken;

    public function __construct(
        HttpClientInterface $client,
        EntityManagerInterface $em
    ) {
        $this->client      = $client;
        $this->em          = $em;
        $this->bearerToken = '';
    }

    public function run()
    {
        $repository = $this->em->getRepository(Setting::class);
        $settingKey = $repository->findOneBy(['settingKey' => 'twitter-bearer-token']);

        if ($settingKey !== null) {
            $this->bearerToken = $settingKey->getValue();
            if ($this->bearerToken !== null) {
                $this->getContent();
            } else {
                //todo alert about it
            }
        }
    }

    private function getContent()
    {
        $filterListRepository = $this->em->getRepository(FilterList::class);
        $filters              = $filterListRepository->findAll();
        foreach ($filters as $filter) {
            $twitterMaxIdRepository = $this->em->getRepository(TwitterMaxId::class);
            $twitterMaxId           = $twitterMaxIdRepository->findOneBy(
                ['filter' => $filter]
            );
            $maxId                  = $twitterMaxId->getMaxId();

            //todo catch
            //todo check code
            //todo another logic
            $apiUrl   = 'https://api.twitter.com/1.1/search/tweets.json?q=' . urlencode($filter->getFilter());
            $response = $this->client->request(
                'GET',
                $apiUrl,
                [
                    'auth_bearer' => $this->bearerToken,
                ]
            );

            //todo catch
            //todo catch for data?
            $json = json_decode($response->getContent(), true);
            usort($json['statuses'], [$this, 'sortById']);
            array_reverse($json);

            foreach ($json['statuses'] as $key => $item) {
                if ($maxId < $item['id']) {
                    $twitterContent = new TwitterContent();
                    $twitterContent->setFilter($filter);
                    $twitterContent->setCreatedAt(new \DateTime($item['created_at']));
                    $twitterContent->setOriginalId($item['id']);
                    $twitterContent->setText($item['text']);
                    $twitterContent->setUserScreenName($item['user']['screen_name']);

                    $this->em->persist($twitterContent);
                    $maxId = $item['id'];
                    $twitterMaxId->setMaxId($maxId);
                }
            }
        }
        $this->em->flush();
    }

    protected function sortById(array $a, array $b): int
    {
        return strnatcmp($a['id'], $b['id']);
    }

}
