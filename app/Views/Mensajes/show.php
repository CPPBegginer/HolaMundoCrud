<?php /** @var array $mensaje */ ?>

<article class="card wide">

 <?php if (!empty($mensaje['imagen'])): ?>

  <img src="<?= htmlspecialchars($mensaje['imagen']) ?>" alt="Imagen" class="banner"/>

 <?php endif; ?>

 <h2><?= htmlspecialchars($mensaje['titulo']) ?></h2>

 <p><?= nl2br(htmlspecialchars($mensaje['descripcion'])) ?></p>

 <p class="muted">Fecha: <?= htmlspecialchars($mensaje['fecha']) ?> • Creado: <?= htmlspecialchars($mensaje['created_at']) ?></p>



 <form method="post" action="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/delete" onsubmit="return confirm('¿Eliminar este mensaje?');">

  <input type="hidden" name="id" value="<?= (int)$mensaje['id'] ?>"/>

  <a class="btn" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/edit?id=<?= (int)$mensaje['id'] ?>">Editar</a>

  <button type="submit" class="btn danger">Eliminar</button>

  <a class="btn secondary" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes">Volver</a>

 </form>

</article>

