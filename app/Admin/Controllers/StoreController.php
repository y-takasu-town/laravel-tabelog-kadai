<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StoreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'))->sortable();
        $grid->column('category.name', __('Category Name'));
        $grid->column('image', __('Image'))->image();        $grid->column('discription', __('Discription'));
        $grid->column('open_time', __('Open time'));
        $grid->column('close_time', __('Close time'));
        $grid->column('price_range', __('Price range'))->sortable();
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('holiday', __('Holiday'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

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
        $show = new Show(Store::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('category.name', __('Category Name'));
        $show->field('image', __('Image'))->image();        $show->field('discription', __('Discription'));
        $show->field('open_time', __('Open time'));
        $show->field('close_time', __('Close time'));
        $show->field('price_range', __('Price range'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('holiday', __('Holiday'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Store());

        $form->text('name', __('Name'));
        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->text('discription', __('Discription'));
        $form->time('open_time', __('Open time'))->default(date('H:i:s'));
        $form->time('close_time', __('Close time'))->default(date('H:i:s'));
        $form->number('price_range', __('Price range'));
        $form->text('postal_code', __('Postal code'));
        $form->text('address', __('Address'));
        $form->text('phone_number', __('Phone number'));
        $form->text('holiday', __('Holiday'));
        $form->image('image', __('Image'));

        return $form;
    }
}
