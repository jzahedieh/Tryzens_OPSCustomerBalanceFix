<?php

class Tryzens_OPSCustomerBalanceFix_Model_CustomerBalance_Observer extends Enterprise_CustomerBalance_Model_Observer
{
    /**
     * Shouldn't handle OPS double save as making order base_customer_balance_invoiced x 2
     *
     * @param Varien_Event_Observer $observer
     * @return Enterprise_CustomerBalance_Model_Observer
     */
    public function increaseOrderInvoicedAmount(Varien_Event_Observer $observer)
    {
        $invoice = $observer->getEvent()->getInvoice();

        if ($invoice->getDoubleSaveFlag()) {
            return $this;
        }

        return parent::increaseOrderInvoicedAmount($observer);
    }
}