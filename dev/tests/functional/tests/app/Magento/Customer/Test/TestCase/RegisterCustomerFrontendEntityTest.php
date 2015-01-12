<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Customer\Test\TestCase;

use Magento\Customer\Test\Fixture\CustomerInjectable;
use Magento\Customer\Test\Page\CustomerAccountCreate;
use Magento\Cms\Test\Page\CmsIndex;
use Magento\Customer\Test\Page\CustomerAccountLogout;
use Mtf\TestCase\Injectable;

/**
 * Test Flow:
 * 1. Go to frontend.
 * 2. Click Register link.
 * 3. Fill registry form.
 * 4. Click 'Create account' button.
 * 5. Perform assertions.
 *
 * @group Customer_Account_(CS)
 * @ZephyrId MAGETWO-23546
 */
class RegisterCustomerFrontendEntityTest extends Injectable
{
    /* tags */
    const MVP = 'yes';
    const DOMAIN = 'CS';
    const TEST_TYPE = 'acceptance_test';
    /* end tags */

    /**
     * @var CustomerAccountCreate
     */
    protected $customerAccountCreate;

    /**
     * @var CustomerAccountLogout
     */
    protected $customerAccountLogout;

    /**
     * @var CmsIndex $cmsIndex
     */
    protected $cmsIndex;

    /**
     * @param CustomerAccountCreate $customerAccountCreate
     * @param CustomerAccountLogout $customerAccountLogout
     * @param CmsIndex $cmsIndex
     */
    public function __inject(
        CustomerAccountCreate $customerAccountCreate,
        CustomerAccountLogout $customerAccountLogout,
        CmsIndex $cmsIndex
    ) {
        $this->customerAccountLogout = $customerAccountLogout;
        $this->customerAccountCreate = $customerAccountCreate;
        $this->cmsIndex = $cmsIndex;
    }

    /**
     * Create Customer account on frontend
     *
     * @param CustomerInjectable $customer
     */
    public function test(CustomerInjectable $customer)
    {
        //Steps
        $this->cmsIndex->open();
        $this->cmsIndex->getLinksBlock()->openLink('Register');
        $this->customerAccountCreate->getRegisterForm()->registerCustomer($customer);
    }

    /**
     * Logout customer from frontend account
     *
     * return void
     */
    public function tearDown()
    {
        $this->customerAccountLogout->open();
    }
}
