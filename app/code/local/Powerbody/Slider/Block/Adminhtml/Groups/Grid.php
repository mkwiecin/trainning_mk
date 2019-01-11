<?php

class Powerbody_Slider_Block_Adminhtml_Groups_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('groupsGrid');
        $this->setDefaultSort('event_date');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel
        ('powerbody_slider/group')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper
            ('powerbody_slider')->__('Id'),
            'width' => 50,
            'index' => 'id',
            'sortable' => false,
        ));
        $this->addColumn('name', array(
            'header' => Mage::helper
            ('powerbody_slider')->__('Name'),
            'index' => 'name',
            'sortable' => false,
        ));

        return parent::_prepareColumns();
    }

//    public function getRowUrl($row)
//    {
//        return $this->getUrl('*/*/edit', array('id' => $row->getEntityId()));
//    }
//
//    protected function _prepareMassaction()
//    {
//        $this->setMassactionIdField('entity_id');
//        $this->getMassactionBlock()->setFormFieldName('registries');
//        $this->getMassactionBlock()->addItem('delete', array(
//            'label' => Mage::helper('mdg_giftregistry')->__('Usuń'),
//            'url' => $this->getUrl('*/*/massDelete'),
//            'confirm' => Mage::helper('mdg_giftregistry')->__('Czy na pewno?')
//        ));
//        return $this;
//    }

}