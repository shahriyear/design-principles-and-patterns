<?php
 
 interface TransactionInterface
 {
     public function transaction($amount);
 }
  
 abstract class TransactionAbstract
 {
     private $typeOfTransaction;
 
     public function setTypeOfTransaction(TransactionInterface $typeOfTransaction)
     {
         $this->typeOfTransaction = $typeOfTransaction;
         return $this;
     }
     
     public function makeTransaction($amount, TransactionInterface $typeOfTransaction = null)
     {
         if ($typeOfTransaction) {
             $this->setTypeOfTransaction($typeOfTransaction);
         }

         if (!$this->typeOfTransaction) {
             return "Set type of transaction first!";
         }
         
         return $this->typeOfTransaction->transaction($amount);
     }
 }
 
 

 class Account extends TransactionAbstract
 {
     private $username;
     private $accountType;
     private $status = 0;
 
     
     public function open($username, $accountType)
     {
         if ($this->status == 1) {
             return 'Can not create a new user!'.PHP_EOL.PHP_EOL;
         }
         $this->username = $username;
         $this->accountType = $accountType;
         $this->status = 1;
         return "Dear, {$username} Congrats your {$accountType} account is ready!".PHP_EOL.PHP_EOL;
     }
         
     public function close()
     {
         if ($this->status == 0) {
             return;
         }
         $msg = "Dear, {$this->username} your {$this->accountType} account is closed!";
         $this->username = '';
         $this->accountType = '';
         $this->isClosed = 0;
         return $msg;
     }
 }


 class PaymentTransaction implements TransactionInterface
 {
     public function transaction($amount)
     {
         return "Payment {$amount} tk is successful!";
     }
 }
 

 class WithdrawTransaction implements TransactionInterface
 {
     public function transaction($amount)
     {
         return "Withdraw {$amount} tk successful!";
     }
 }
 
 class ReversePendingTransaction implements TransactionInterface
 {
     public function transaction($amount)
     {
         return "Reverse {$amount} tk in pending!";
     }
 }
 
 class ReverseConfirmTransaction implements TransactionInterface
 {
     public function transaction($amount)
     {
         return "Reverse {$amount} tk confirmed successfully!";
     }
 }
 
 $account = new Account;

 //account open method
 echo $account->open("Sam", 'saving');
 
 //payment method with dedicated setter
 echo $account->setTypeOfTransaction(new PaymentTransaction)->makeTransaction(100).PHP_EOL.PHP_EOL;

//payment method
 echo $account->makeTransaction(120, new PaymentTransaction).PHP_EOL.PHP_EOL;
 
 // withdraw method
 echo $account->makeTransaction(-110, new WithdrawTransaction).PHP_EOL.PHP_EOL;
 
 // reverse pending method
 echo $account->makeTransaction(10, new ReversePendingTransaction).PHP_EOL.PHP_EOL;
 
 // reverse confirmed method
 echo $account->makeTransaction(10, new ReverseConfirmTransaction).PHP_EOL.PHP_EOL;
 
 //account close method
 echo $account->close().PHP_EOL.PHP_EOL;
