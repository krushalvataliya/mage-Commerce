 <?php

class Kv_Banner_Model_Group extends Mage_Core_Model_Abstract
{
    function __construct()
    {
        $this->_init('banner/group');
    }
    public function getGroupArray()
    {
        $groups = $this->getCollection()->getData();
        $id = array_column($groups, 'group_id');
        $name = array_column($groups, 'name');
        $groupArray = array_combine($id,$name);
        return $groupArray;    
    }
}
