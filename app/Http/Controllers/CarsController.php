<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CarCreateRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Repositories\CarRepository;
use App\Validators\CarValidator;

/**
 * Class CarsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CarsController extends Controller
{
    /**
     * @var CarRepository
     */
    protected $repository;

    /**
     * @var CarValidator
     */
    protected $validator;

    /**
     * CarsController constructor.
     *
     * @param CarRepository $repository
     * @param CarValidator $validator
     */
    public function __construct(CarRepository $repository, CarValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $cars = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cars,
            ]);
        }

        return view('cars.index', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CarCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CarCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $car = $this->repository->create($request->all());

            $response = [
                'message' => 'Car created.',
                'data'    => $car->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $car,
            ]);
        }

        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = $this->repository->find($id);

        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CarUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $car = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Car updated.',
                'data'    => $car->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Car deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Car deleted.');
    }
}
