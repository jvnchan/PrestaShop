<?php
/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler;

use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\CmsPage\Command\AddCmsPageCommand;
use PrestaShop\PrestaShop\Core\Domain\CmsPage\ValueObject\CmsPageId;
use PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\Exception\CmsPageCategoryException;

class CmsPageFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Create object from form data.
     *
     * @param array $data
     *
     * @return int
     *
     * @throws CmsPageCategoryException
     */
    public function create(array $data)
    {
        /**
         * @var CmsPageId
         */
        $cmsPageId = $this->commandBus->handle(new AddCmsPageCommand(
            (int) $data['page_category'],
            $data['title'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keyword'],
            $data['friendly_url'],
            $data['content'],
            $data['is_indexed_for_search'],
            $data['is_displayed'],
            is_array($data['shop_association']) ? $data['shop_association'] : []
        ));

        return $cmsPageId->getValue();
    }

    /**
     * Update object with form data.
     *
     * @param int $id
     * @param array $data
     *
     * @return int ID of identifiable object
     */
    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }
}
