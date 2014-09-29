<?php
class Cache_Driver{
 
 
    //获取缓存信息
    public function get($id)
    {
       $data = apc_fetch($id);
       if (!is_array($data))
       {
            $data = apc_fetch($id);
       }
 
        return (is_array($data)) ? $data[0] : FALSE;
    }
    //设置缓存信息
    public function set($id, $data, $ttl = 300)
    {
        return apc_store($id, array($data, time(), $ttl), $ttl);
    }
    //删除key值对应的缓存
    public function delete($id)
    {
        return apc_delete($id);
    }
}
?>