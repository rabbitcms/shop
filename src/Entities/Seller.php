<?php
declare(strict_types = 1);
namespace RabbitCMS\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use RabbitCMS\Shop\Contracts\SellerContract;

/**
 * Class Seller
 * @package RabbitCMS\Shop
 * @property-read int $id
 * @property string $caption
 * @property bool $enabled
 * @property array $options
 */
class Seller extends Model implements SellerContract
{
    protected $table = 'shop2_sellers';

    protected $casts = [
        'options' => 'array',
        'enabled' => 'bool'
    ];

    /**
     * @param array $value
     */
    protected function setOptionsAttribute(array $value)
    {
        $this->attributes['options'] = Crypt::encrypt($this->asJson($value));
    }

    /**
     * @return array
     */
    protected function getOptionsAttribute(): array
    {
        if (empty($this->attributes['options'])) {
            return [];
        }
        return $this->fromJson(Crypt::decrypt($this->attributes['options']));
    }

    /**
     * @inheritdoc
     */
    public function setOption(string $key, $value)
    {
        $this->options = Arr::set($this->options, $key, $value);
    }

    /**
     * @inheritdoc
     */
    public function getOption(string $key, $default = null)
    {
        return Arr::get($this->getOptionsAttribute(), $key, $default);
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->getAttribute('caption');
    }

    /**
     * @inheritdoc
     */
    public function isEnabled(): bool
    {
        return $this->getAttribute('enabled');
    }

    /**
     * @inheritdoc
     */
    public function setEnabled(bool $value = true)
    {
        $this->setAttribute('enabled', $value);
    }
}
