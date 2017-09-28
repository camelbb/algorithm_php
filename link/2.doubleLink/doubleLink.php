<?php

/**
 * Class Node
 * 双向链表结点
 */
class Node
{
    private $_data; //节点数据

    private $_pre; //上一个结点

    private $_next; //下一节点

    public function __construct($data)
    {
        $this->_pre  = null;
        $this->_next = null;
        $this->setData($data);
    }

    public function setData($val)
    {
        $this->_data = $val;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function setPre(&$node)
    {
        if (!$node) {
            return true;
        }
        $this->_pre = $node;
    }
    public function getPre()
    {
        return $this->_pre;
    }

    public function setNext(&$node)
    {
        if (!$node) {
            return false;
        }
        $this->_next = $node;
    }

    public function getNext()
    {
        return $this->_next;
    }

    public function resetPre()
    {
        $this->_pre = null;
    }

    public function resetNext()
    {
        $this->_next = null;
    }

}

/**
 * Class linkNode
 * 双向链表
 */
class linkNode
{
    private $_head; //头节点

    private $_tail; //尾结点

    public function __construct(&$headNode, &$tailNode)
    {
        $headNode->setNext($tailNode);
        $tailNode->setPre($headNode);
        $this->_head = $headNode;
        $this->_tail = $tailNode;
    }

    //切换链表头
    public function setHead(&$node)
    {
        $node->resetPre();
        $node->setNext($this->_head->getNext());
        unset($this->_head);
    }

    public function getHead()
    {
        return $this->_head;
    }

    //切换链表尾
    public function setTail(&$node)
    {
        $node->resetNext();
        $node->setHead($this->_tail->getPre());
        unset($this->_tail);
    }

    public function getTail()
    {
        return $this->_tail;
    }

    public function getSize()
    {
        if (!$this->_head) {
            return 0;
        }
        $i    = 1;
        $node = $this->_head;
        while ($node->getNext() != null) {
            $i++;
            $node = $node->getNext();
        }
        return $i;
    }

    /**
     * 在尾部添加添加数据
     */
    public function addValue($data)
    {
        $tail = new Node($data);
        $tail->setPre($this->_tail);
        $this->_tail->setNext($tail);
        $this->_tail = $tail;
    }

    public function addNode(&$node)
    {
        $this->_tail->setNext($node);
        $node->resetNext();
        $node->setPre($this->_tail);
        $this->_tail = $node;
    }

    /**
     * 删除第index个节点
     */
    public function removeAt($index)
    {
        if ($index < 1) {
            return false;
        }
        $len = $this->getSize();
        if ($len < $index) {
            return false;
        }
        $node = $this->_head;
        for ($i = 1; $i < $index; $i++) {
            $node = $node->getNext();
        }

        $node->getPre()->setNext($node->getNext());
        $node->getNext()->setPre($node->getPre());
    }

    /**
     * 获取某个节点
     */
    public function getOne($index)
    {
        $node = $this->_head;
        if ($node == null) {
            return false;
        }
        if ($index == 1) {
            return $node;
        }

        for ($i = 1; $i < $index; $i++) {
            $node = $node->getNext();
        }

        return $node;
    }

    /**
     * 获取所有的节点
     */
    public function getAll()
    {
        $list = [];
        $node = $this->_head;
        if (!$node) {
            return $list;
        }

        $list[] = $node;
        if ($node->getNext() == null) {
            return $list;
        }

        while ($node->getNext()) {
            $node   = $node->getNext();
            $list[] = $node;
        }

        return $list;
    }

    /**
     * 更新节点数据
     */
    public function update($index, $value)
    {
        if ($index < 1) {
            return false;
        }
        if ($index == 1) {
            $this->_head->setData($value);
        }

        $node = $this->_head;
        for ($i = 1; $i < $index; $i++) {
            $node = $node->getNext();
            if (!$node) {
                return false;
            }
        }

        $node->setData($value);
        return $node;
    }

    /**
     * 展示所有的结点数据
     */
    public function getAllValue()
    {
        $list = [];
        $node = $this->_head;
        if (!$node) {
            return $list;
        }

        $list[] = $node->getData();
        if ($node->getNext() == null) {
            return $list;
        }

        while ($node->getNext()) {
            $node   = $node->getNext();
            $list[] = $node->getData();
        }

        return $list;
    }
}

//创建节点
$node1 = new Node(1);
$node2 = new Node(2);
$node3 = new Node(3);

//初始化一个链表 $node1表头，$node2表尾
$linkNode = new linkNode($node1, $node2);

//增加节点
$linkNode->addNode($node3);
$linkNode->addValue(4);
//var_dump($linkNode->getAllValue());exit;

//删除节点
$linkNode->removeAt(2);
//var_dump($linkNode->getAllValue());exit;

//查看第X个结点
$node = $linkNode->getOne(3);
//var_dump($node);

//修改
$linkNode->update(3, 'a333');
var_dump($linkNode->getAll());
