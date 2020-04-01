<?php


namespace App\UserEvents\LevelReached;


use App\UserAbilities\UnlockedAbilityRepository;
use App\UserEvents\Data;
use App\UserEvents\DataFormatter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LevelReachedDataFormatter implements DataFormatter
{
    private UnlockedAbilityRepository $unlockedAbilityRepository;

    private TokenStorageInterface $tokenStorage;

    public function __construct(UnlockedAbilityRepository $unlockedAbilityRepository, TokenStorageInterface $tokenStorage)
    {
        $this->unlockedAbilityRepository = $unlockedAbilityRepository;
        $this->tokenStorage = $tokenStorage;
    }

    public function supports(Data $data): bool
    {
        return $data instanceof LevelReachedData;
    }

    /**
     * @param Data|LevelReachedData $data
     * @return array
     */
    public function format(Data $data): array
    {
        $unlockedAbility = $this->unlockedAbilityRepository->findAbilityForLevel($this->tokenStorage->getToken()->getUser()->id(), $data->level);

        return [
            'level' => $data->level,
            'pointsUntilNextLevel' => $data->pointsUntilNextLevel,
            'unlockedAbility' => $unlockedAbility ? $unlockedAbility->key() : null
        ];
    }

}