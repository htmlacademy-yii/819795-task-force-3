<?php

class Task
{
  private $executor;

  private $customer;

  private $status;


  const STATUS_NEW = 'new';
  const STATUS_CANCEL = 'cancel';
  const STATUS_IN_WORK = 'inwork';
  const STATUS_DONE = 'done';
  const STATUS_FAIL = 'failed';


  const ACTION_CREATE = 'action_create';
  const ACTION_CANCEL = 'action_cancel';
  const ACTION_RESPOND = 'action_respond';
  const ACTION_REFUSE = 'action_refuse';
  const ACTION_DONE = 'action_done';

  const STATUSES_ARRAY = [
          self::STATUS_NEW => 'Новый',
          self::STATUS_CANCEL => 'Отменено',
          self::STATUS_IN_WORK => 'В работе',
          self::STATUS_DONE => 'Выполнено',
          self::STATUS_FAIL => 'Провалено',
      ];

  CONST ACTIONS_ARRAY = [
         self::ACTION_CREATE => 'Создать',
         self::ACTION_CANCEL => 'Отменить',
         self::ACTION_RESPOND => 'Откликнуться',
         self::ACTION_REFUSE => 'Отказаться',
         self::ACTION_DONE => 'Выполнено',
  ];

  public function getStatusesMap ()
  {
      return self::STATUSES_ARRAY;
  }

  public function getActionsMap ()
  {
      return self::ACTIONS_ARRAY;
  }


  public function setCustomer ($str)
  {
      $this->customer = strval($str);
  }

  public function setExecutor ($str)
  {
        $this->executor = strval($str);
  }

  public function setStatus ($str)
  {
        $this->status = $str;
  }

  public function __construct($customer, $status = 'new', $executor = null)
  {
        $this->setCustomer($customer);
        $this->setExecutor($executor);
        $this->setStatus($status);
  }

  public function getNextStatus($action)
  {
       switch ($action) {
            case self::ACTION_CREATE:
                return self::STATUS_NEW;
            case self::ACTION_CANCEL:
                return self::STATUS_CANCEL;
            case self::ACTION_DONE:
                return self::STATUS_DONE;
            case self::ACTION_RESPOND:
                return self::STATUS_IN_WORK;
           case self::ACTION_REFUSE:
               return self::STATUS_FAIL;
        }
        return null;
  }

  public function getAllowedActions($role)
   {
        if ($this->status==self::STATUS_NEW) {
            switch ($role) {
                case ($this->customer):
                    return self::ACTION_CANCEL;
                case ($this->executor):
                    return self::ACTION_RESPOND;
            }
        }
        if ($this->status==self::STATUS_IN_WORK) {
            switch ($role) {
                case ($this->customer):
                    return self::ACTION_DONE;
                case ($this->executor):
                    return self::ACTION_REFUSE;
            }
        }
        return null;
   }
}

