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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;

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
    ];

    const PAPER = [
        'a4' => 'A4',
        'legal' => 'Legal/F4',
    ];

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return 'eProduk Hukum';
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
            ->header('eProduk Hukum')
            ->description('Daftar Data')
            ->breadcrumb(
                ['text' => 'Produk Hukum', 'url' => '/produk_hukum'],
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
            ->header('eProduk Hukum')
            ->description('Detil')
            ->breadcrumb(
                ['text' => 'Produk Hukum', 'url' => '/produk_hukum'],
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
            ->header('eProduk Hukum')
            ->description('Ubah')
            ->breadcrumb(
                ['text' => 'Produk Hukum', 'url' => '/produk_hukum'],
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
            ->header('eProduk Hukum')
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
            0 => 'warning',
            1 => 'success',
            2 => 'danger',
        ]);
        $grid->updated_at(trans('admin.updated_at'))->width(150)->date('d-m-Y')->sortable();
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
        $show->paper('Kertas');
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

        $form->text('nomor', 'Nomor')->setWidth(2, 2)->rules('required|numeric')->autofocus();
        $form->text('tahun', 'Tahun')->setWidth(2, 2)->rules('required|size:4');
        $form->textarea('judul', 'Judul')->setWidth(10, 2)->rules('required')->rows(2);
        $form->ckeditor('isi')->setWidth(10, 2)->rules('required');
        $form->text('kota', 'Ditetapkan di')->setWidth(2, 2)->rules('required');
        $form->date('tanggal', 'Tanggal')->rules('required|date');
        $form->table('extra', function ($table) {
            $table->text('jabatan');
        });
        $form->date('retensi', 'Retensi')->rules('required|date');
        $form->select('paper', 'Ukuran Kertas')->setWidth(2, 2)->options(self::PAPER)->rules('required');
        $form->text('sandi', 'Sandi')->setWidth(3, 2)->rules('required');
        $form->select('status', 'Status')->setWidth(2, 2)->options(self::STATUS);
        $form->hidden('kode_acak');

        if ($form->isEditing()) {
            $form->tools(function (Form\Tools $tools) {
                $id = request()->segment(3);
                $tools->add('
                    <div class="btn-group pull-right" style="padding-right: 5px">
                        <a href="/unduh/'.$id.'/pdf" class="btn btn-sm btn-success" title="Unduh PDF" target="_blank">
                            <i class="fa fa-download"></i>
                            <span class="hidden-xs">&nbsp;Unduh PDF</span>
                        </a>
                        <a href="/admin/produk_hukum/'.$id.'/preview" class="btn btn-sm btn-warning" title="Pratinjau" target="_blank">
                            <i class="fa fa-eye"></i>
                            <span class="hidden-xs">&nbsp;Pratinjau</span>
                        </a>
                    </div>
                ');
            });
        } else {
            $form->footer(function ($footer) {
                $footer->disableReset(false);
                $footer->disableSubmit(false);
            });
        }

        $form->saving(function (Form $form) {
            $form->kode_acak = Str::random(40);
        });

        return $form;
    }

    public function preview(int $id)
    {
        $produk = ProdukHukum::find($id);
        $pdf = PDF::loadView('pdf', compact('produk'))->setPaper($produk->paper);
        $title = 'SK-'.trim($produk->nomor).'-'.trim($produk->tahun);
        $filename = $title.'.pdf';
        Storage::disk('public')->put($filename, $pdf->output());

        return view('preview', [
            'title' => $title,
            'file' => $filename,
        ]);
    }
}
