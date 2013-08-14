<?php
class Base_Error extends Base
{
    public function __construct($glObj)
    { 
        parent :: __construct($glObj); 
    }
	
	public function getList($fromDate='', $toDate='')
	{	
		$pcnt = _v('pcnt', 10);
		$page = _v('page', 1);
		$ajax = _v('ajaxMode', 0);
		$dfrom = _v('dfrom', '');
		$dto = _v('dto', '');
		
        $this->mSmarty->assign('amodule', 'error');	
		$this->mSmarty->assign('page', ($page>1)?$page*10:$page);
				
		$this->mSmarty->assignByRef('dfrom', $dfrom);	
		$this->mSmarty->assignByRef('dto', $dto);	
		
		if($dfrom || $dto)
		{
			include_once 'model/Valid.class.php';
			
			$fromDate = Valid::validDate($dfrom);
			$toDate = Valid::validDate($dto);
	
			if($toDate == -1 || $toDate == -2) $toDate = '';
			if($fromDate == -1 || $fromDate == -2 ) $fromDate = '';
		}

		if($ajax)
		{
			$result = Error::getErrors($fromDate, $toDate, $page, $pcnt);			
			$rcnt = Error::getErrorsCount($fromDate, $toDate);

			$this->mSmarty->assign('list', $result);
			
			
			$res['q'] = 'ok';			
			$res['dfrom'] = $dfrom;
			$res['dto'] =  $dto;
			
			include_once 'model/Pagging.class.php';
			$link = 'oAdmin.ErrorList';
			
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);

			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
						
			$res['data'] = $this->mSmarty->Fetch('mods/admin/error/ajax/_list_ajax.html');

			
			echo json_encode($res);
			exit();				
			
		}
		else
		{
			$result = Error::getErrors($fromDate, $toDate, $page, $pcnt);
			$rcnt = Error::getErrorsCount($fromDate, $toDate);
			$this->mSmarty->assign('list', $result);

			include_once 'model/Pagging.class.php';
			$link = 'oAdmin.ErrorList';
			
			$mpg = new Pagging($pcnt, $rcnt, $page, $link);

			$pagging = $mpg->Make($this->mSmarty, 1);
			$this->mSmarty->assign('pagging', $pagging);
			
			$this->mSmarty->display('mods/admin/error/_list.html');
		
		}
	}
}
