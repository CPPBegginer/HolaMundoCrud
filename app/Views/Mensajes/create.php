<?php /** @var string|null $error */ ?>

<section>

 <h2>Nuevo Mensaje</h2>

 <?php if (!empty($error)): ?>

  <div class="alert"><?= htmlspecialchars($error) ?></div>

 <?php endif; ?>

 <form method="post"

   action="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/Mensajes/store"

   enctype="multipart/form-data"

   class="form">



  <label>Título

   <input type="text" name="titulo" required maxlength="120" />

  </label>

  <label>Descripción

   <textarea name="descripcion" rows="5" required></textarea>

  </label>

  <label>Fecha

   <input type="date" name="fecha" required />

  </label>

  <label>Imagen (opcional)

   <input type="file" name="img" accept=".jpg,.jpeg,.png,.gif,.webp" />

  </label>

  <button type="submit" class="btn">Guardar</button>

  <a class="btn secondary" href="/Mensajes">Cancelar</a>

 </form>

</section>

