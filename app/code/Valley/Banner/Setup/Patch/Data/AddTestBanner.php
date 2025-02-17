<?php

namespace Valley\Banner\Setup\Patch\Data;

use Valley\Banner\Model\BannerFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddTestBanner implements DataPatchInterface
{
    public function __construct(
        protected BannerFactory $bannerFactory
    ) {}

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $banner = $this->bannerFactory->create();
            $banner->setImage(null)
                ->setLink($faker->url())
                ->setSortOrder($faker->numberBetween(1, 100))
                ->setStatus($faker->randomElement([1, 0]));

            $banner->save();
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
