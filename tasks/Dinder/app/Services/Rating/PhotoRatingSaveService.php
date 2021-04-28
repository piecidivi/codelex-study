<?php

namespace App\Services\Rating;

use App\Models\History;
use App\Repositories\History\HistoryRepository;
use App\Repositories\Users\UserRepository;
use Exception;

class PhotoRatingSaveService
{
    private UserRepository $userRepository;
    private HistoryRepository $historyRepository;

    public function __construct(UserRepository $userRepository, HistoryRepository $historyRepository)
    {
        $this->userRepository = $userRepository;
        $this->historyRepository = $historyRepository;
    }

    /**
     * @throws \Exception
     */
    public function save(int $userid, int $checkedId, string $like): void
    {
        try {
            $checkedUser = $this->userRepository->getById($checkedId);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        $history = new History($userid, $checkedUser->id(), $checkedUser->name(), $like);

        try {
            $this->historyRepository->addRecord($history, $userid);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}