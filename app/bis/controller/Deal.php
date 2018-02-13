<?php 
namespace app\bis\controller;
use think\Controller;
/**
* 团购控制器
*/
class Deal extends Base
{
	
	   /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
  
    	$account = $this->isLogin();
  		$where = [
  			'bis_id'	=> $account->id,
  		];
        $deals = model('deal')->getRecommondDeal($where);
        return $this->fetch('', [
            'deals'     => $deals,
        ]);
    }



	public function add()
	{
		$bisId = $this->isLogin()->bis_id;
		if(request()->isPost()){
			$data = input('post.');

			$validate = validate('deal');
			if(!$validate->scene('add')->check($data)){
				dump($validate->getError());
			}
			//获取分类路径
            $data['cat'] = '';
            if(!empty($data['se_category_id'])){
                $data['cat'] = implode('|', $data['se_category_id']);
            }

            $location = model('bis_location')->get($data['location_ids'][0]);
			$dataDeal = [
				'name'               => $data['name'],
				'category_id'        => $data['category_id'],
				'se_category_id'     => empty($data['se_category_id']) ? '' : implode(',', $data['se_category_id']),
				'bis_id'             => $bisId,
				'location_ids'       => empty($data['location_ids']) ? '' : implode(',', $data['location_ids']),
				'image'              => $data['image'],
				'city_id'            => $data['city_id'],
				'total_count'		 => $data['total_count'],
				'start_time'         => strtotime($data['start_time']),
				'end_time'           => strtotime($data['end_time']),
				'origin_price'       => number_format($data['origin_price'], 2),
				'current_price'      => number_format($data['current_price'], 2),
				'coupons_begin_time' => empty($data['coupons_begin_time'])?'' : strtotime($data['coupons_begin_time']),
				'coupons_end_time'   => empty($data['coupons_end_time'])?'' : strtotime($data['coupons_end_time']),
				'description'        => empty($data['description']) ? '' : $data['description'] ,
				'notes'              => empty($data['notes']) ? '' : $data['notes'] ,
				'xpoint'             => $location->xpoint,
				'ypoint'             => $location->ypoint,
				'bis_account_id'     => $this->isLogin()->id,
			];

			if(model('deal')->add($dataDeal)){
				$this->success('添加团购成功');
			}else{
				$this->error('添加团购失败');
			}
		}else{
			$citys = model('city')->getNormalFistCity();
	        $categorys = model('category')->getFirstCategory();
	        $locations = model('bis_location')->getNormalLocationByBisId($bisId);
	        return $this->fetch('',[
	            'citys'      => $citys,
	            'categorys' => $categorys,
	            'locations'	=> $locations,
	        ]);
		}
		
	}


	public function edit()
	{
		$bisId = $this->isLogin()->bis_id;
		if(request()->isPost()){
			$data = input('post.');
			$validate = validate('deal');
			if(!$validate->scene('add')->check($data)){
				dump($validate->getError());
			}
			//获取分类路径
            $data['cat'] = '';
            if(!empty($data['se_category_id'])){
                $data['cat'] = implode('|', $data['se_category_id']);
            }

            //$location = model('bis_location')->get($data['location_ids'][0]);
			$dataDeal = [
				'name'               => $data['name'],
				// 'category_id'        => $data['category_id'],
				// 'se_category_id'     => empty($data['se_category_id']) ? '' : implode(',', $data['se_category_id']),
				// 'bis_id'             => $bisId,
				// 'location_ids'       => empty($data['location_ids']) ? '' : implode(',', $data['location_ids']),
				// 'image'              => $data['image'],
				// 'city_id'            => $data['city_id'],
				'total_count'		 => $data['total_count'],
				'start_time'         => strtotime($data['start_time']),
				'end_time'           => strtotime($data['end_time']),
				'origin_price'       => number_format($data['origin_price'], 2),
				'current_price'      => number_format($data['current_price'], 2),
				'coupons_begin_time' => empty($data['coupons_begin_time'])?'' : strtotime($data['coupons_begin_time']),
				'coupons_end_time'   => empty($data['coupons_end_time'])?'' : strtotime($data['coupons_end_time']),
				'description'        => empty($data['description']) ? '' : $data['description'] ,
				'notes'              => empty($data['notes']) ? '' : $data['notes'] ,
				//'xpoint'             => $location->xpoint,
				//'ypoint'             => $location->ypoint,
				'bis_account_id'     => $this->isLogin()->id,
				'status'		     => 0,
			];

			if(model('deal')->save($dataDeal,['id'=>$data['id'] ])){
				$this->success('添加团购成功');
			}else{
				$this->error('添加团购失败');
			}
		}else{
			$id = input('get.id');
			if(!$id){
				return $this->error('找不到对应数据');
			}
			$deal = model('deal')->get($id);
			if(!$deal){
				return $this->error('找不到对应数据');
			}
			$citys = model('city')->getNormalFistCity();
	        $categorys = model('category')->getFirstCategory();
	        $locations = model('bis_location')->getNormalLocationByBisId($bisId);
	        return $this->fetch('',[
				'deal'      => $deal,
				'citys'     => $citys,
				'categorys' => $categorys,
				'locations' => $locations,
	        ]);
		}
		
	}
}

 ?>