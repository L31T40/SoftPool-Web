    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Processjson extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
		$this->load->model('jsonmod');
        
    }
	
	public function useid($id)
	{	
		$url = base_url().'index.php/getjson/getid/'.$id;
		
        $json = file_get_contents($url);
        
		$decoding = json_decode($json);
        
        return $decoding;
				
	}
    
    
    
    
}
