<?php
namespace component\traits;
use \Component\Http\RestClient;
trait notetrait{
	protected $_noteClient;
	
	function initNoteClient(array $config){
		$this->_noteClient = new RestClient([
            'base_uri' => $config['base_uri'],
            'app_id' => $config['app_id'], 'app_secret' => $config['app_secret'],
        ]);
	}
	 /**
     * get note page list data
     */
    public function lists(array $map, $order = '', $page = 1, $ps = 20)
    {
        $param['order'] = $order;
        $param['page'] = $page;
        $param['ps'] = $ps;
        $param = $param + $map;

        $response = $this->_noteClient->get('/note/home/notes',
            ['query' => $param]
        );

        return $response;
    }
    /**
     * add note
     */
    public function add($data){
        return $this->_noteClient->post('/note/home/note',['form_params'=>$data]);
    }
}