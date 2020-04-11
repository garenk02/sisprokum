<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ProdukHukumExporter;
use App\Models\ProdukHukum;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProdukHukumController extends Controller
{
    use HasResourceActions;

    const TIPE = [
        1 => '3 Tanda tangan',
        2 => '4 Tanda tangan',
    ];

    const STATUS = [
        0 => 'Draf',
        1 => 'Aktif',
        2 => 'Non-aktif',
    ];

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return 'Produk Hukum';
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Produk Hukum')
            ->description('Daftar Data')
            ->breadcrumb(
                ['text' => 'Produk Hukum', 'url' => '/admin/produk_hukum'],
            )
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Produk Hukum')
            ->description('Detil')
            ->breadcrumb(
                ['text' => 'Produk Hukum', 'url' => '/admin/produk_hukum'],
                ['text' => 'Detil'],
            )
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Produk Hukum')
            ->description('Ubah')
            ->breadcrumb(
                ['text' => 'Produk Hukum', 'url' => '/admin/produk_hukum'],
                ['text' => 'Ubah'],
            )
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Produk Hukum')
            ->description('Buat Baru')
            ->breadcrumb(
                ['text' => 'Produk Hukum', 'url' => '/produk_hukum'],
                ['text' => 'Buat Baru']
            )
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProdukHukum);

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('nomor', 'Nomor');
            $filter->like('tahun', 'Tahun');
            $filter->like('judul', 'Judul');
        });
        $grid->quickSearch('nomor', 'tahun', 'judul');
        $grid->nomor('Nomor')->width(100)->filter()->sortable();
        $grid->tahun('Tahun')->width(100)->filter()->sortable();
        $grid->judul('Judul')->width(500)->filter()->sortable();
        $grid->status('Status')->display(function ($status) {
            return self::STATUS[$status];
        })->width(100)->filter(self::STATUS)->sortable()->label([
            self::STATUS[0] => 'warning',
            self::STATUS[1] => 'success',
            self::STATUS[2] => 'danger',
        ]);
        $grid->updated_at(trans('admin.updated_at'))->width(150)->date('Y-m-d H:i:s')->sortable();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });
        $grid->exporter(new ProdukHukumExporter());

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProdukHukum::findOrFail($id));

        $show->nomor('Nomor');
        $show->tahun('Tahun');
        $show->judul('Judul');
        $show->isi('Isi Surat');
        $show->tipe('Tipe')->using(self::TIPE);
        $show->retensi('Retensi');
        $show->status('Status')->using(self::STATUS);
        $show->sandi('Sandi');
        $show->qrcode('QR Code');
        $show->kode_acak('Kode Acak');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProdukHukum);

        $form->text('nomor', 'Nomor')->setWidth(2, 2)->rules('required|numeric|gte:5')->autofocus();
        $form->text('tahun', 'Tahun')->setWidth(2, 2)->rules('required|size:4');
        $form->text('judul', 'Judul')->setWidth(10, 2)->rules('required|min:3');
        $form->ckeditor('isi')->setWidth(10, 2)->rules('required');
        $form->select('tipe', 'Tipe')->setWidth(2, 2)->rules('required')->options(self::TIPE);
        $form->date('retensi', 'Retensi')->rules('required|date');
        $form->text('sandi', 'Sandi')->setWidth(3, 2)->rules('required');
        $form->select('status', 'Status')->setWidth(2, 2)->options(self::STATUS);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
