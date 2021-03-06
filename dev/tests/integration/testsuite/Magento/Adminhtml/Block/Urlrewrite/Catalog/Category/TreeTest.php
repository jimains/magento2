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
 * @package     Magento_Adminhtml
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Adminhtml\Block\Urlrewrite\Catalog\Category;

/**
 * Test for \Magento\Adminhtml\Block\Urlrewrite\Catalog\Category\Tree
 *
 * @magentoAppArea adminhtml
 */
class TreeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Adminhtml\Block\Urlrewrite\Catalog\Category\Tree
     */
    private $_treeBlock;

    /**
     * Set up
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_treeBlock = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
            ->get('Magento\View\LayoutInterface')
            ->createBlock('Magento\Adminhtml\Block\Urlrewrite\Catalog\Category\Tree');
    }

    /**
     * Test for method \Magento\Adminhtml\Block\Urlrewrite\Catalog\Category\Tree::getTreeArray()
     */
    public function testGetTreeArray()
    {
        $expectedTreeArray = array(
            'id'             => 1,
            'parent_id'      => 0,
            'children_count' => 1,
            'is_active'      => false,
            'name'           => 'Root',
            'level'          => 0,
            'product_count'  => 0,
            'children'       => array(array(
                'id'             => 2,
                'parent_id'      => 1,
                'children_count' => 0,
                'is_active'      => true,
                'name'           => 'Default Category',
                'level'          => 1,
                'product_count'  => 0,
                'cls'            => 'active-category',
                'expanded'       => false
            )),
            'cls'            => 'no-active-category',
            'expanded'       => true,
        );

        $this->assertEquals($expectedTreeArray, $this->_treeBlock->getTreeArray(),
            'Tree array is invalid');
    }

    /**
     * Test prepare grid
     */
    public function testGetLoadTreeUrl()
    {
        $row = new \Magento\Object(array('id' => 1));
        $this->assertStringStartsWith('http://localhost/index.php', $this->_treeBlock->getLoadTreeUrl($row),
            'Tree load URL is invalid');
    }

    /**
     * Test for method \Magento\Adminhtml\Block\Urlrewrite\Catalog\Category\Tree::getCategoryCollection()
     */
    public function testGetCategoryCollection()
    {
        $collection = $this->_treeBlock->getCategoryCollection();
        $this->assertInstanceOf('Magento\Catalog\Model\Resource\Category\Collection', $collection);
    }
}
