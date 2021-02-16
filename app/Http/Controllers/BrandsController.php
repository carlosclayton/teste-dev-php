<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Repositories\BrandRepository;
use App\Validators\BrandValidator;

/**
 * Class BrandsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BrandsController extends Controller
{
    /**
     * @var BrandRepository
     */
    protected $repository;

    /**
     * @var BrandValidator
     */
    protected $validator;

    /**
     * BrandsController constructor.
     *
     * @param BrandRepository $repository
     * @param BrandValidator $validator
     */
    public function __construct(BrandRepository $repository, BrandValidator $validator)
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
        $brands = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $brands,
            ]);
        }

        return view('brands.index', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BrandCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BrandCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $brand = $this->repository->create($request->all());

            $response = [
                'message' => 'Brand created.',
                'data'    => $brand->toArray(),
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
        $brand = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $brand,
            ]);
        }

        return view('brands.show', compact('brand'));
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
        $brand = $this->repository->find($id);

        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BrandUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $brand = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Brand updated.',
                'data'    => $brand->toArray(),
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
                'message' => 'Brand deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Brand deleted.');
    }
}
