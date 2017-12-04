<?php

namespace App\Http\Controllers;

use App\Http\Model\ProductType;
use App\Http\Model\Product;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $children  = array();
        $category = ProductType::getAll();

        foreach ($category as $index => $row){
            if (!empty($row['parentid'])) {
                $children[$row['parentid']][] = $row;
                unset($category[$index]);
            }
        }

        $class_arr = array();
        $keywords = "";

        if(!empty($request->input('class_id')) || !empty($request->input('keywords'))){
            $class_id = $request->input('class_id');
            $keywords = $request->input('keywords');

            $product = Product::orderBy("displayorder","asc");
            if(!empty($keywords)){
                $product = $product->where("name",'like', '%'.$keywords.'%');
            }

            if(!empty($class_id)){
                $class_arr = explode("#",$class_id);
                if($class_arr[1]){
                    //echo "二级";
                    $parentid = ProductType::getClass($class_arr[1])->parentid;
                    $parent_name = ProductType::getClassName($parentid)->name;

                    $zd_name = ($parent_name == "课程")?"course_cate":"class_cate";
                    $product = $product->where($zd_name, $class_arr[1]);


                }else{
                    //echo "一级";
                    $parent_name = ProductType::getClassName($class_arr[0])->name;
                    $parent_id = $class_arr[0];

                    $class_ids = ProductType::where("parentid",$parent_id)->pluck('id');

                    $zd_name = ($parent_name == "课程")?"course_cate":"class_cate";

                    $product = $product->whereIn($zd_name,$class_ids);

                }
            }


            $product = $product->select(["id","course_cate","class_cate","name","thumb","price","displayorder","status","updated_at"]);
        }else{

            $product = Product::orderBy("displayorder","asc")->select(["id","course_cate","class_cate","name","thumb","price","displayorder","status","updated_at"]);
        }

        $rs = $product->paginate(15);
        return view("admin.products.pList",compact("category","children","rs","class_arr","keywords"));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class_1 = ProductType::getTwoClass(1);
        $class_2 = ProductType::getTwoClass(2);
        return view("admin.products.pAdd",compact("class_1","class_2"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $course_cate = trim($request->input('course_cate'));
        $class_cate = trim($request->input('class_cate'));
        $name = trim($request->input('name'));
        $thumb = trim($request->input('thumb'));
        $price = trim($request->input('price'));
        $value = trim($request->input('value'));
        $video_url = trim($request->input('video_url'));
        $detail = trim($request->input('detail'));
        $message = 0;
        if($course_cate == ""){
            $message_arr['course'] = "请选择所属课程";
            $message = 1;
        }
        if($class_cate == ""){
            $message_arr['class'] = "请选择所属班级";
            $message = 1;
        }
        if($name == ""){
            $message_arr['name'] = "产品名称不能为空";
            $message = 1;
        }
        if($thumb == ""){
            $message_arr['pic'] = "请选择产品图片";
            $message = 1;
        }
        if($price == ""){
            $message_arr['price'] = "价格不能为空";
            $message = 1;
        }
        if($value == ""){
            $message_arr['value'] = "价值不能为空";
            $message = 1;
        }
        if($message == 1){

            $class_1 = ProductType::getTwoClass(1);
            $class_2 = ProductType::getTwoClass(2);
            return view("admin.products.pAdd",compact("class_1","class_2","message_arr"));
        }else{

            $product = new Product();
            $product->course_cate = $course_cate;
            $product->class_cate = $class_cate;
            $product->name = $name;
            $product->thumb = $thumb;
            $product->price = $price;
            $product->value = $value;
            $product->video_url = $video_url;
            $product->detail = $detail;
            $product->save();
            return redirect("/admin/product");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rs = Product::getProduct($id);
        $class_1 = ProductType::getTwoClass(1);
        $class_2 = ProductType::getTwoClass(2);
        return view("admin.products.pEdit",compact("rs","class_1","class_2"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $course_cate = trim($request->input('course_cate'));
        $class_cate = trim($request->input('class_cate'));
        $name = trim($request->input('name'));
        $thumb = trim($request->input('thumb'));
        $price = trim($request->input('price'));
        $value = trim($request->input('value'));
        $visit_1 = trim($request->input('visit_1'));
        $visit_2 = trim($request->input('visit_2'));
        $video_url = trim($request->input('video_url'));
        $detail = trim($request->input('detail'));
        $message = 0;
        if($course_cate == ""){
            $message_arr['course'] = "请选择所属课程";
            $message = 1;
        }
        if($class_cate == ""){
            $message_arr['class'] = "请选择所属班级";
            $message = 1;
        }
        if($name == ""){
            $message_arr['name'] = "产品名称不能为空";
            $message = 1;
        }
        if($thumb == ""){
            $message_arr['pic'] = "请选择产品图片";
            $message = 1;
        }
        if($price == ""){
            $message_arr['price'] = "价格不能为空";
            $message = 1;
        }
        if($value == ""){
            $message_arr['value'] = "价值不能为空";
            $message = 1;
        }
        if($message == 1){

            $class_1 = ProductType::getTwoClass(1);
            $class_2 = ProductType::getTwoClass(2);
            return view("admin.products.pAdd",compact("class_1","class_2","message_arr"));
        }else{

            $product = Product::find($request->input('id'));
            $product->course_cate = $course_cate;
            $product->class_cate = $class_cate;
            $product->name = $name;
            $product->thumb = $thumb;
            $product->price = $price;
            $product->value = $value;
            $product->visit_1 = $visit_1;
            $product->visit_2 = $visit_2;
            $product->video_url = $video_url;
            $product->detail = $detail;
            $rs = $product->save();
            if($rs){
                return redirect("/admin/product");
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return Product::find($id)->delete() ? "200":"500";
    }

    //处理上传的商品图片
    public function picUpload(Request $request){
        $file = $request->file('pic');
        if ($file->isValid()) {

            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            $size = $file->getClientSize();//图像大小


            // 上传文件
            $filename = date('Y')  . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('uploads_img')->put($filename, file_get_contents($realPath));

            $pic="uploads/".$filename;
            return json_encode($pic);



        }

    }


    //批量更新
    public function batchUpdate(Request $request)
    {

        $rs = $request->input("ids");
        $rs = array_filter($rs);    //过滤空数组
        $sql = "INSERT product(id,`displayorder`) VALUES";
        foreach ($rs as $key => $val) {
            $sql .= "($key,$val),";
        }
        $sql = trim($sql, ",");
        $sql .= " ON DUPLICATE KEY UPDATE `displayorder` = VALUES(`displayorder`)";

        if(DB::insert($sql)){
            return "200";
        }else{
            return "500";
        }
    }


    //更新状态
    public function statusx($id){
        $orm = Product::where("id",$id)->first();
        if($orm->status == 1){
            $orm->status = 0; //下架
        }else{
            $orm->status = 1;
        }
        $orm->save();
        $message = ($orm->status == 0) ?"下架":"上架";
        return json_encode($message);

    }

    public function myRedirect($url,$msg){
        echo "<script>
                alert('$msg');
                location.href='$url'
            </script>";
    }


    //前端商城
    public function products(){
        $orm=new Product();
        $num=$orm->count();
        $cnt=8;
        $max=ceil($num/$cnt);
        $arr=range(1,$max);
        $curr=isset($_GET['page'])?$_GET['page']:1;
        if(in_array($curr,$arr)){
            $left=max(1,$curr-1);
            $right=min($left+2,$max);
            $left=max(1,$right-2);
            $page=[];
            for($i=$left;$i<=$right;$i++){
                $page[$i]="page=".$i;
            }
            $offset=($curr-1)*$cnt;
            $rs=Product::offset($offset)->limit($cnt)->get();
            foreach ($rs as $k=>$v){
                $rs[$k]->detail=strip_tags($v->detail);
            }
            //$rs=Product::all();
            return view("web.Products",["rs"=>$rs,"page"=>$page,"curr"=>$curr,"max"=>$max]);
        }else{
            $this->myRedirect("/products","查找的页面不存在");
        }
    }
}
