<?php


namespace App\Facade;


use App\Entity\File;
use App\Exception\UploadedFileException;
use App\Serializer\FileSerializer;
use App\Service\SaveFileFromRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UploaderFacade
{
    private SaveFileFromRequest $saveFileFromRequest;
    private EntityManagerInterface $entityManager;
    private FileSerializer $fileSerializer;

    public function __construct(
        SaveFileFromRequest $saveFileFromRequest,
        EntityManagerInterface $entityManager,
        FileSerializer $fileSerializer

    )
    {
        $this->saveFileFromRequest = $saveFileFromRequest;
        $this->entityManager = $entityManager;
        $this->fileSerializer = $fileSerializer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws UploadedFileException
     */
    public function upload(Request $request): JsonResponse
    {
        $this->saveFileFromRequest->save($request);

        return $this->list($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $output = [];
        foreach ($this->getFiles() as $file) {
            $output[] = $this->fileSerializer->serialize($file);
        }

        return new JsonResponse($output);
    }

    /**
     * @return File[]
     */
    private function getFiles(): iterable
    {
        return $this->entityManager->getRepository(File::class)->findBy([], [
            'createdAt' => 'DESC'
        ]);
    }
}
