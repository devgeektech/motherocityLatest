<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Controllers\API;


use Config\Services;
use App\Models\UserModel;
use App\Models\ContentModel;
use App\Models\Common_model;
trait CommonTrait
{
    /**
     * Allows child classes to override the
     * status code that is used in their API.
     *
     * @var array<string, int>
     */
    
    private function GetUserDetails($id)
    {
        $this->common_model = new Common_model;
        $this->db      = \Config\Database::connect();
        $data = $this->common_model->GetSingleData('users' , array('id' => $id),'id','asc',array('*',"CONCAT('" .site_url() ."',image) AS image"));
        if (!$data ) {
            
            return $data; exit;
        }
       
        $data['image'] = $this->common_model->GetAllData('user_images',array('user_id' => $id),'id','desc');
        return $data;
    } 

    
}
