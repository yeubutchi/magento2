<?php
/**
 * Application config storage
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Core\Model\Config;

class Storage extends \Magento\Core\Model\Config\AbstractStorage
{
    /**
     * @param \Magento\Core\Model\Config\Cache $cache
     * @param \Magento\Core\Model\Config\Loader $loader
     * @param \Magento\Core\Model\Config\BaseFactory $factory
     */
    public function __construct(
        \Magento\Core\Model\Config\Cache $cache,
        \Magento\Core\Model\Config\Loader $loader,
        \Magento\Core\Model\Config\BaseFactory $factory
    ) {
        parent::__construct($cache, $loader, $factory);
    }

    /**
     * Retrieve application configuration
     *
     * @return \Magento\Core\Model\ConfigInterface
     */
    public function getConfiguration()
    {
        $config = $this->_cache->load();
        if (false === $config) {
            $config = $this->_configFactory->create('<config/>');
            $this->_loader->load($config);
            $this->_cache->save($config);
        }
        return $config;
    }

    /**
     * Remove configuration cache
     */
    public function removeCache()
    {
        $this->_cache->clean();
    }
}
