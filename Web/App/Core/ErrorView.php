<?
class ErrorView {
    private $errorCode;

    public function __construct($errorCode) {
        $this->errorCode = $errorCode;
    }

    public function render() {
        $errorCode = htmlspecialchars($this->errorCode, ENT_QUOTES, 'UTF-8');

        ob_start();
        include 'error_template.php';
        return ob_get_clean();
    }
}