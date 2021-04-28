<?php

namespace App\Services\Rating;

use App\Repositories\History\HistoryRepository;
use App\Repositories\Users\UserRepository;
use Exception;

class PhotoRatingLoadService
{
    private HistoryRepository $historyRepository;
    private UserRepository $userRepository;

    public function __construct(HistoryRepository $historyRepository, UserRepository $userRepository)
    {
        $this->historyRepository = $historyRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function load(int $userid, string $sex, string $preference): array
    {
        try {
            $historyCollection = $this->historyRepository->getHistoryByUserId($userid);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        $checkedIdCollection = $historyCollection->checkedIdCollection();
        $checkedIdCollection[] = $userid;   // Add user own id to filter from showing self.

        if ($preference === "A") {
            try {
                $checkUser = $this->userRepository->filterForRatingAll($checkedIdCollection, $sex);
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        } else {
            try {
                $checkUser = $this->userRepository->filterForRatingSpecific($checkedIdCollection, $sex, $preference);
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        }

        return [
            "checkUser" => $checkUser,
            "history" => $historyCollection
        ];
    }
}