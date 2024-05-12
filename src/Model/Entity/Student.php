<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher; // Add this line

/**
 * Student Entity
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $nis
 * @property string $address
 * @property \Cake\I18n\Date $birth_date
 * @property string $gender
 * @property string $level
 * @property \Cake\I18n\DateTime $created
 */
class Student extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'username' => true,
        'password' => true,
        'nis' => true,
        'address' => true,
        'birth_date' => true,
        'gender' => true,
        'level' => true,
        'created' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
