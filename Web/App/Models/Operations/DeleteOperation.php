<?
namespace App\Operations;
abstract class DeleteOperation extends DatabaseRelatedOperation {
  static abstract public function deleteFromDatabase($id);
}