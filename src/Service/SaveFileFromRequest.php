<?php


namespace App\Service;


use App\Entity\File;
use App\Exception\UploadedFileException;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class SaveFileFromRequest
{
    private string $uploaderStorage;
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        string $uploaderStorage
    )
    {
        $this->entityManager = $entityManager;
        $this->uploaderStorage = $uploaderStorage;
    }

    /**
     * @param Request $request
     * @throws UploadedFileException
     */
    public function save(Request $request): void
    {
        $uploadedFile = $request->files->get('file');
        if (!($uploadedFile instanceof UploadedFile)) {
            throw new UploadedFileException();
        }

        $dateStringNow = (new DateTime())->format('YmdHis');
        $originalName = $uploadedFile->getClientOriginalName();
        $name = sprintf('%s_%s_%s', $dateStringNow, $this->generateRandomString(), $originalName);

        $uploadedFile->move(
            $this->uploaderStorage,
            $name,
        );

        $file = new File();
        $file
            ->setName($originalName)
            ->setSize($uploadedFile->getSize())
            ->setUrl(sprintf('/storage/%s', $name));

        $this->entityManager->persist($file);
        $this->entityManager->flush();
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
