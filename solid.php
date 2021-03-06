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
 
 

 class Transaction extends TransactionAbstract
 {
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
 
  
  class LoanSanctionTransaction implements TransactionInterface
  {
      public function transaction($amount)
      {
          return "Loan sanction payment {$amount} tk is successful!";
      }
  }
 class LoanInstallmentTransaction implements TransactionInterface
 {
     public function transaction($amount)
     {
         return "Loan installment payment {$amount} tk is successful!";
     }
 }
 
//  $transaction = new Transaction;

//  //account open method
// //  echo $account->open("Sam", 'saving');
 
// //payment method
//  echo $transaction->makeTransaction(120, new PaymentTransaction).PHP_EOL.PHP_EOL;
 
//  // withdraw method
//  echo $transaction->makeTransaction(-110, new WithdrawTransaction).PHP_EOL.PHP_EOL;
 
//  // reverse pending method
//  echo $transaction->makeTransaction(10, new ReversePendingTransaction).PHP_EOL.PHP_EOL;
 
//  // reverse confirmed method
//  echo $transaction->makeTransaction(10, new ReverseConfirmTransaction).PHP_EOL.PHP_EOL;
 
//  //account close method
//  //echo $account->close().PHP_EOL.PHP_EOL;
 
 
 
 
 

 
 interface AccountInterface
 {
     public function open();
     public function close();
     public function balance();
 }
 
 abstract class AccountAbstract
 {
     private $typeOfAccount;
 
     public function setTypeOfAccount(AccountInterface $typeOfAccount)
     {
         $this->typeOfAccount = $typeOfAccount;
         return $this;
     }
     
     public function openAccount()
     {
         if (!$this->typeOfAccount) {
             return "Set type of account first!";
         }
         
         return $this->typeOfAccount->open();
     }
     
     public function closeAccount()
     {
         if (!$this->typeOfAccount) {
             return "Set type of account first!";
         }
         
         return $this->typeOfAccount->close();
     }
     
     public function balanceAccount()
     {
         if (!$this->typeOfAccount) {
             return "Set type of account first!";
         }
         
         return $this->typeOfAccount->balance();
     }
 }
 
 
 class Account extends AccountAbstract
 {
 }
 
 class SavingAccount implements AccountInterface
 {
     public function open()
     {
         return "Saving Account created";
     }
     
     public function close()
     {
         return "Saving Account closed";
     }
     
     public function balance()
     {
         return "Saving Account balance";
     }
 }
 
  class LoanAccount implements AccountInterface
  {
      public function open()
      {
          return "Loan Account created";
      }
     
      public function close()
      {
          return "Loan Account closed";
      }
     
      public function balance()
      {
          return "Loan Account balance";
      }
  }
 
//  $account = new Account;
//  $account->setTypeOfAccount(new SavingAccount);
//  echo $account->openAccount().PHP_EOL.PHP_EOL;
 
//  $account->setTypeOfAccount(new LoanAccount);
//  echo $account->closeAccount().PHP_EOL.PHP_EOL;
 
 
 
 
 
// /////////////Demo Controller////////////// //
 
 class SavingAccountController
 {
     public function create()
     {
         $account = new Account;
         $account->setTypeOfAccount(new SavingAccount);
         echo $account->openAccount().PHP_EOL.PHP_EOL;
     }
     
     public function deposit()
     {
         $transaction = new Transaction;
         echo $transaction->makeTransaction(150, new PaymentTransaction).PHP_EOL.PHP_EOL;
     }
     
     public function withdraw()
     {
         $transaction = new Transaction;
         echo $transaction->makeTransaction(-40, new PaymentTransaction).PHP_EOL.PHP_EOL;
     }
     
     public function balance()
     {
         $account = new Account;
         $account->setTypeOfAccount(new SavingAccount);
         echo $account->balanceAccount().PHP_EOL.PHP_EOL;
     }
     
     public function destroy()
     {
         $account = new Account;
         $account->setTypeOfAccount(new SavingAccount);
         echo $account->closeAccount().PHP_EOL.PHP_EOL;
     }
 }
 
 $o = new SavingAccountController();
 $o->create();
 $o->deposit();
 $o->withdraw();
 $o->balance();
 $o->destroy();
 
  class LoanAccountController
  {
      public function create()
      {
          $account = new Account;
          $account->setTypeOfAccount(new LoanAccount);
          echo $account->openAccount().PHP_EOL.PHP_EOL;
      }
     
      public function sanction()
      {
          $transaction = new Transaction;
          echo $transaction->makeTransaction(-1500, new LoanSanctionTransaction).PHP_EOL.PHP_EOL;
          echo $transaction->makeTransaction(-15, new PaymentTransaction).PHP_EOL.PHP_EOL;
      }
     
      public function installment()
      {
          $transaction = new Transaction;
          echo $transaction->makeTransaction(50, new LoanInstallmentTransaction).PHP_EOL.PHP_EOL;
      }
     
      public function balance()
      {
          $account = new Account;
          $account->setTypeOfAccount(new LoanAccount);
          echo $account->balanceAccount().PHP_EOL.PHP_EOL;
      }
     
      public function destroy()
      {
          $account = new Account;
          $account->setTypeOfAccount(new LoanAccount);
          echo $account->closeAccount().PHP_EOL.PHP_EOL;
      }
  }
 echo PHP_EOL.PHP_EOL;
 $o = new LoanAccountController();
 $o->create();
 $o->sanction();
 $o->installment();
 $o->balance();
 $o->destroy();
