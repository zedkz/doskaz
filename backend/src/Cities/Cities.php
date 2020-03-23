<?php


namespace App\Cities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cities")
 */
class Cities
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="geometry", options={"geometry_type" = "POLYGON"})
     */
    private $bbox;

    /**
     * @ORM\Column(type="integer")
     */
    private $priority;

    public function __construct(int $id, string $name, int $priority)
    {
        $this->id = $id;
        $this->name = $name;
        $this->priority = $priority;
    }

    public static function list()
    {
        return [
            ['id' => 106724, 'name' => 'Нур-Султан', 'bounds' => [[51.0006766, 71.2244414], [51.3511101, 71.7851913]]],
            ['id' => 158106, 'name' => 'Алматы', 'bounds' => [[43.0328438, 76.7382775], [43.4036849, 77.1667539]]],
            ['id' => 110170, 'name' => 'Актау'],
            ['id' => 68402, 'name' => 'Актобе'],
            ['id' => 26551, 'name' => 'Атырау'],
            ['id' => 80696, 'name' => 'Капшагай'],
            ['id' => 212922, 'name' => 'Караганда'],
            ['id' => 155241, 'name' => 'Кокшетау'],
            ['id' => 125193, 'name' => 'Костанай'],
            ['id' => 165288, 'name' => 'Кызылорда'],
            ['id' => 9103, 'name' => 'Павлодар', 'bounds' => [[52.2234455, 76.8608794], [52.3988251, 77.12136]]],
            ['id' => 33335, 'name' => 'Семей',],
            ['id' => 79497, 'name' => 'Талдыкорган'],
            ['id' => 168533, 'name' => 'Тараз'],
            ['id' => 182036, 'name' => 'Туркестан'],
            ['id' => 178771, 'name' => 'Шымкент'],
            ['id' => 51071, 'name' => 'Уральск'],
            ['id' => 31223, 'name' => 'Усть-Каменогорск'],
            ['id' => 113407, 'name' => 'Петропавловск'],
            ['id' => 1313, 'name' => 'Экибастуз'],
            ['id' => 9, 'name' => 'Аксу'],
            ['id' => 211201, 'name' => 'Балхаш'],
            ['id' => 211888, 'name' => 'Жезказган'],
            ['id' => 156843, 'name' => 'Степногорск'],
            ['id' => 125938, 'name' => 'Аркалык'],
            ['id' => 214204, 'name' => 'Сарань'],
            ['id' => 180937, 'name' => 'Арыс'],
            ['id' => 181562, 'name' => 'Кентау'],
            ['id' => 212498, 'name' => 'Каражал'],
            ['id' => 81062, 'name' => 'Текели'],
            ['id' => 126778, 'name' => 'Рудный'],
            ['id' => 168004, 'name' => 'Байконыр'],
            ['id' => 215326, 'name' => 'Шахтинск'],
            ['id' => 214126, 'name' => 'Приозерск'],
            ['id' => 126589, 'name' => 'Лисаковск'],
            ['id' => 214935, 'name' => 'Темиртау'],
            ['id' => 32845, 'name' => 'Риддер'],
            ['id' => 110672, 'name' => 'Жанаозен'],
            ['id' => 214573, 'name' => 'Сатпаев'],
            ['id' => 32808, 'name' => 'Курчатов'],
        ];
    }

    public static function find(int $id): ?array
    {
        foreach (self::list() as $item) {
            if ($item['id'] === $id) {
                return $item;
            }
        }
        return null;
    }
}
