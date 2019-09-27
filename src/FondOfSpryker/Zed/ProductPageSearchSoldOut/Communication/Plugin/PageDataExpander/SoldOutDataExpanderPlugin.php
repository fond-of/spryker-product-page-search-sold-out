<?php

namespace FondOfSpryker\Zed\ProductPageSearchSoldOut\Communication\Plugin\PageDataExpander;

use FondOfSpryker\Shared\ProductPageSearchSoldOut\ProductPageSearchSoldOutConstants;
use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

class SoldOutDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    public const PLUGIN_NAME = 'SoldOutDataExpanderPlugin';

    /**
     * @param array $productData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(array $productData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): void
    {
        if (!array_key_exists(ProductPageSearchSoldOutConstants::ATTRIBUTES, $productData)) {
            return;
        }

        $productAttributeData = \json_decode($productData[ProductPageSearchSoldOutConstants::ATTRIBUTES], true);

        if (!array_key_exists(PageIndexMap::IS_SOLD_OUT, $productAttributeData)) {
            return;
        }

        if (!method_exists($productAbstractPageSearchTransfer, 'setIsSoldOut')) {
            return;
        }

        $productAbstractPageSearchTransfer->setIsSoldOut($productAttributeData[PageIndexMap::IS_SOLD_OUT]);
    }
}
