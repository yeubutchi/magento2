<?php
/**
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
 * @category    Magento
 * @package     Magento_Sales
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Sales Mysql resource helper model
 */
namespace Magento\Sales\Model\Resource;

class Helper extends \Magento\Core\Model\Resource\Helper
    implements \Magento\Sales\Model\Resource\HelperInterface
{
    /**
     * @var \Magento\Reports\Model\Resource\Helper
     */
    protected $_reportsResourceHelper;

    /**
     * @param \Magento\Core\Model\Resource $resource
     * @param \Magento\Reports\Model\Resource\Helper $reportsResourceHelper
     * @param string $modulePrefix
     */
    public function __construct(
        \Magento\Core\Model\Resource $resource,
        \Magento\Reports\Model\Resource\Helper $reportsResourceHelper,
        $modulePrefix = 'sales'
    ) {
        parent::__construct($resource, $modulePrefix);
        $this->_reportsResourceHelper = $reportsResourceHelper;
    }

    /**
     * Update rating position
     *
     * @param string $aggregation One of \Magento\Sales\Model\Resource\Report\Bestsellers::AGGREGATION_XXX constants
     * @param array $aggregationAliases
     * @param string $mainTable
     * @param string $aggregationTable
     * @return \Magento\Sales\Model\Resource\Helper
     */
    public function getBestsellersReportUpdateRatingPos($aggregation, $aggregationAliases,
        $mainTable, $aggregationTable
    ) {
        if ($aggregation == $aggregationAliases['monthly']) {
            $this->_reportsResourceHelper->updateReportRatingPos('month', 'qty_ordered', $mainTable, $aggregationTable);
        } elseif ($aggregation == $aggregationAliases['yearly']) {
            $this->_reportsResourceHelper->updateReportRatingPos('year', 'qty_ordered', $mainTable, $aggregationTable);
        } else {
            $this->_reportsResourceHelper->updateReportRatingPos('day', 'qty_ordered', $mainTable, $aggregationTable);
        }

        return $this;
    }
}
