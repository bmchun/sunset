<?php
/**
 * TOP API: taobao.atb.items.detail.get
 * 
 * @author auto create
 * @since 1.0, 2015.07.22
 */
class AtbItemsDetailGetRequest
{
	/** 
	 * 需返回的字段列表.可选值:Area 结构中的所有字段;多个字段之间用","分隔.如:id,type,name,parent_id,zip.
	 **/
	private $fields;
	private $open_iids;
	
	private $apiParas = array();
	
	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}
	
	public function setOpeniids($open_iids)
	{
		$this->open_iids = $open_iids;
		$this->apiParas["open_iids"] = $open_iids;
	}
	
	public function getOpen_iids()
	{
		return $this->open_iids;
	}

	public function getApiMethodName()
	{
		return "taobao.atb.items.detail.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->fields,"fields");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
