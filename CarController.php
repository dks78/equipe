<?php
class CarController
{
    private CarModel $model;
    private CarView $view;

    public function __construct(CarModel $model, CarView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function showCarList(string $searchTerm): void
    {
        $results = $this->model->filterCars($searchTerm);
        $this->view->displayCars($results);
    }
}
