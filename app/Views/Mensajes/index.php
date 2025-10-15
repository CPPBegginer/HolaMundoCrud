<?php /** @var array $mensajes */ ?>

<section>

 <h2>Lista de Mensajes</h2>

 <?php if (empty($mensajes)): ?>

  <div class="empty">No hay mensajes aún. Crea el primero.</div>

 <?php else: ?>

  <div class="grid">

   <?php foreach ($mensajes as $m): ?>

    <article class="card">

     <?php if (!empty($m['imagen'])): ?>

      <img src="<?= htmlspecialchars($m['imagen']) ?>" alt="Imagen" class="thumb"/>

     <?php endif; ?>

     <h3><?= htmlspecialchars($m['titulo']) ?></h3>

     <p><?= nl2br(htmlspecialchars(mb_strimwidth($m['descripcion'], 0, 140, '…'))) ?></p>

     <p class="muted">Fecha: <?= htmlspecialchars($m['fecha']) ?></p>

     <div class="row">

      <a class="btn" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/show?id=<?= (int)$m['id'] ?>">Ver</a>

      <a class="btn secondary" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/edit?id=<?= (int)$m['id'] ?>">Editar</a>

     </div>

    </article>

   <?php endforeach; ?>

  </div>

 <?php endif; ?>

</section>

