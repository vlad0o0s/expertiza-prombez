<?php
// Секция документов компании
$documents = $data['documents'] ?? [
    [
        'name' => 'Свидетельство о гос. регистрации<br />некоммерческой организации',
        'link' => '#',
        'icon_vectors' => [
            'vector-58-3.svg',
            'vector-59.svg',
            'vector-60.svg'
        ]
    ],
    [
        'name' => 'Свидетельство о постановке<br />на учет в налоговом органе',
        'link' => '#',
        'icon_vectors' => [
            'vector-58.svg',
            'vector-59-3.svg',
            'vector-60-2.svg'
        ]
    ],
    [
        'name' => 'Свидетельство об аттестации<br />лаборатории',
        'link' => '#',
        'icon_vectors' => [
            'vector-58-2.svg',
            'vector-59-2.svg',
            'vector-60-3.svg'
        ]
    ]
];
?>

<section class="about-documents">
    <div class="container">
        <h2 class="about-documents-title">НАШИ ДОКУМЕНТЫ</h2>
        <div class="about-documents-list">
            <?php foreach ($documents as $document): ?>
                <article class="about-document-item">
                    <div class="about-document-icon">
                        <img src="/assets/images/doc.png" alt="PDF документ" class="about-document-icon-image" />
                    </div>
                    <div class="about-document-content">
                        <h3 class="about-document-name"><?php echo $document['name']; ?></h3>
                        <a href="<?php echo htmlspecialchars($document['link']); ?>" class="about-document-link" download>Скачать файл</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

