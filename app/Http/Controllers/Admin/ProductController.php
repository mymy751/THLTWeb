<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Respository\CategoryRespository;
use App\Respository\ProducerRepository;
use App\Respository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public $_productRepo;
    public $_producerRepo;
    public $_cateRepo;
    public function __construct(ProductRepository $productRepo, ProducerRepository $producerRepo, CategoryRespository $cateRepo)
    {
        $this->_productRepo = $productRepo;
        $this->_producerRepo = $producerRepo;
        $this->_cateRepo = $cateRepo;
    }

    public function index()
    {
        $products = $this->_productRepo->getProductAdmin();
        return view('admin.pages.product.index', compact('products'));
    }

    public function productCreate()
    {
        $producers = $this->_producerRepo->getAllProducer();
        $categories = $this->_cateRepo->getAllCategory();
        return view('admin.pages.product.create', compact('producers', 'categories'));
    }

    public function productCreatePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nameProduct' => ['required'],
            'pictureProduct' => ['required'],
            'id_producer' => ['required'],
            'id_category' => ['required'],
            'price' => ['required'],
            'ram' => ['required'],
            'cpu' => ['required'],
            'vga' => ['required'],
            'screen' => ['required'],
            'hardDrive' => ['required'],
            'weight' => ['required'],
            'status' => ['required'],
            'new_price' => ['required'],
            'speedcpu' => ['required'],
            'technolory_sreen' => ['required'],
            'technology_studio' => ['required'],
            'material' => ['required'],
            'pin' => ['required'],
            'releasetime' => ['required'],
            'operaSystem' => ['required'],
            'size' => ['required'],
            'caching' => ['required']
        ], [
            'nameProduct.required' => 'Vui l??ng nh???p t??n s???n ph???m',
            'pictureProduct.required' => 'Vui l??ng nh???p h??nh ???nh s???n ph???m',
            'id_producer.required' => 'Vui l??ng nh???p lo???i s???n ph???m',
            'id_category.required' => 'Vui l??ng nh???p danh m???c s???n ph???m',
            'price.required' => 'Vui l??ng nh???p gi?? s???n ph???m',
            'ram.required' => 'Vui l??ng nh???p ram s???n ph???m',
            'cpu.required' => 'Vui l??ng nh???p cpu s???n ph???m',
            'vga.required' => 'Vui l??ng nh???p vga s???n ph???m',
            'screen.required' => 'Vui l??ng nh???p m??n h??nh s???n ph???m',
            'hardDrive.required' => 'Vui l??ng nh???p hardDrive s???n ph???m',
            'weight.required' => 'Vui l??ng nh???p weight s???n ph???m',
            'status.required' => 'Vui l??ng nh???p status s???n ph???m',
            'new_price.required' => 'Vui l??ng nh???p new_price s???n ph???m',
            'speedcpu.required' => 'Vui l??ng nh???p speedcpu s???n ph???m',
            'technolory_sreen.required' => 'Vui l??ng nh???p technolory_sreen s???n ph???m',
            'technology_studio.required' => 'Vui l??ng nh???p technology_studio s???n ph???m',
            'material.required' => 'Vui l??ng nh???p material s???n ph???m',
            'pin.required' => 'Vui l??ng nh???p pin s???n ph???m',
            'releasetime.required' => 'Vui l??ng nh???p releasetime s???n ph???m',
            'operaSystem.required' => 'Vui l??ng nh???p operaSystem s???n ph???m',
            'size.required' => 'Vui l??ng nh???p size s???n ph???m',
            'caching.required' => 'Vui l??ng nh???p caching s???n ph???m',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with([   //??ithinput l?? c??i m?? gi??? l???i d??? li???u c??
                'messages' => $validator->errors()->first(),
                'type' => 'alert-danger'
            ]);
        }
        $file_upload = $request->file('pictureProduct')->store('images', 'public');
        $input_product = $request->all(); // m???ng
        $input_product['pictureProduct'] = $file_upload;
        $product = $this->_productRepo->createProduct($input_product);
        if ($product) {
            return redirect()->back()->with([
                'messages' => 'T???o s???n ph???m th??nh c??ng',
                'type' => 'alert-success'
            ]);
        }
    }

    public function productUpdate(Request $request , $id)
    {
        $product = $this->_productRepo->getProductById($id);
        $producers = $this->_producerRepo->getAllProducer();
        $categories = $this->_cateRepo->getAllCategory();
        return view('admin.pages.product.update', compact('producers', 'categories', 'product'));
    }

    public function productUpdatePost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nameProduct' => ['required'],
            'pictureProduct' => ['required'],
            'id_producer' => ['required'],
            'id_category' => ['required'],
            'price' => ['required'],
            'ram' => ['required'],
            'cpu' => ['required'],
            'vga' => ['required'],
            'screen' => ['required'],
            'hardDrive' => ['required'],
            'weight' => ['required'],
            'status' => ['required'],
            'new_price' => ['required'],
            'speedcpu' => ['required'],
            'technolory_sreen' => ['required'],
            'technology_studio' => ['required'],
            'material' => ['required'],
            'pin' => ['required'],
            'releasetime' => ['required'],
            'operaSystem' => ['required'],
            'size' => ['required'],
            'caching' => ['required']
        ], [
            'nameProduct.required' => 'Vui l??ng nh???p t??n s???n ph???m',
            'pictureProduct.required' => 'Vui l??ng nh???p h??nh ???nh s???n ph???m',
            'id_producer.required' => 'Vui l??ng nh???p lo???i s???n ph???m',
            'id_category.required' => 'Vui l??ng nh???p danh m???c s???n ph???m',
            'price.required' => 'Vui l??ng nh???p gi?? s???n ph???m',
            'ram.required' => 'Vui l??ng nh???p ram s???n ph???m',
            'cpu.required' => 'Vui l??ng nh???p cpu s???n ph???m',
            'vga.required' => 'Vui l??ng nh???p vga s???n ph???m',
            'screen.required' => 'Vui l??ng nh???p m??n h??nh s???n ph???m',
            'hardDrive.required' => 'Vui l??ng nh???p hardDrive s???n ph???m',
            'weight.required' => 'Vui l??ng nh???p weight s???n ph???m',
            'status.required' => 'Vui l??ng nh???p status s???n ph???m',
            'new_price.required' => 'Vui l??ng nh???p new_price s???n ph???m',
            'speedcpu.required' => 'Vui l??ng nh???p speedcpu s???n ph???m',
            'technolory_sreen.required' => 'Vui l??ng nh???p technolory_sreen s???n ph???m',
            'technology_studio.required' => 'Vui l??ng nh???p technology_studio s???n ph???m',
            'material.required' => 'Vui l??ng nh???p material s???n ph???m',
            'pin.required' => 'Vui l??ng nh???p pin s???n ph???m',
            'releasetime.required' => 'Vui l??ng nh???p releasetime s???n ph???m',
            'operaSystem.required' => 'Vui l??ng nh???p operaSystem s???n ph???m',
            'size.required' => 'Vui l??ng nh???p size s???n ph???m',
            'caching.required' => 'Vui l??ng nh???p caching s???n ph???m',


        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with([   //??ithinput l?? c??i m?? gi??? l???i d??? li???u c??
                'messages' => $validator->errors()->first(),
                'type' => 'alert-danger'
            ]);
        }
        $file_upload = $request->file('pictureProduct')->store('images', 'public');
        $input_product = $request->all(); // m???ng
        $input_product['pictureProduct'] = $file_upload;
        $product = $this->_productRepo->updateProduct($input_product, $id);
        if ($product) {
            return redirect()->back()->with([
                'messages' => '???? Ch???nh s???a',
                'type' => 'alert-success'
            ]);
        }
    }

    public function productDelete($id)
    {
        $data = $this->_productRepo->getProductById($id);
        if (!$data) {
            return redirect()->back()->with([   //??ithinput l?? c??i m?? gi??? l???i d??? li???u c??
                'messages' => 'Kh??ng t??m th???y s???n ph???m x??a',
                'type' => 'alert-danger'
            ]);
        }
        $delete = $this->_productRepo->deleteProduct($id);
        return redirect()->back()->with([
            'messages' => 'X??a s???n ph???m th??nh c??ng',
            'type' => 'alert-success'
        ]);
    }
}
