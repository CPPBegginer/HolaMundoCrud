<?php /** @var array $mensaje */ ?>

<section>

 <h2>Editar Mensaje</h2>

 <?php if (!empty($error)): ?>

  <div class="alert"><?= htmlspecialchars($error) ?></div>

 <?php endif; ?>

 <form method="post" action="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/update" enctype="multipart/form-data" class="form">

  <input type="hidden" name="id" value="<?= (int)$mensaje['id'] ?>"/>

  <label>Título

   <input type="text" name="titulo" required maxlength="120" value="<?= htmlspecialchars($mensaje['titulo'] ?? '') ?>"/>

  </label>

  <label>Descripción

   <textarea name="descripcion" rows="5" required><?= htmlspecialchars($mensaje['descripcion'] ?? '') ?></textarea>

  </label>

  <label>Fecha

   <input type="date" name="fecha" required value="<?= htmlspecialchars($mensaje['fecha'] ?? '') ?>"/>

  </label>

  <?php if (!empty($mensaje['imagen'])): ?>

   <p>Imagen actual:</p>

   <img src="<?= htmlspecialchars($mensaje['imagen']) ?>" alt="Imagen actual" class="thumb"/>

  <?php endif; ?>

  <label>Nueva imagen (opcional)

   <input type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif,.webp" />

  </label>

  <button type="submit" class="btn">Actualizar</button>

  <a class="btn secondary" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/show?id=<?= (int)$mensaje['id'] ?>">Cancelar</a>

 </form>

</section>