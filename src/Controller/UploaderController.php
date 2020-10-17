<?php

namespace App\Controller;

use App\Exception\UploadedFileException;
use App\Facade\UploaderFacade;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploaderController
{
    private UploaderFacade $uploaderFacade;

    public function __construct(
        UploaderFacade $uploaderFacade
    )
    {
        $this->uploaderFacade = $uploaderFacade;
    }

    /**
     * @Route("/upload", name="uploader_upload")
     * @param Request $request
     * @return JsonResponse
     * @throws UploadedFileException
     */
    public function upload(Request $request): JsonResponse
    {
        return $this->uploaderFacade->upload($request);
    }

    /**
     * @Route("/list", name="uploader_list")
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        return $this->uploaderFacade->list($request);
    }

}
