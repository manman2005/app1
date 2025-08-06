<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Room</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= $_SESSION['message']; ?></span>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= $_SESSION['error']; ?></span>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="/app1/public/admin/editRoom" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" name="id" value="<?= htmlspecialchars($roomData->id); ?>">
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="room_number">
                Room Number:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="room_number" type="text" name="room_number" value="<?= htmlspecialchars($roomData->room_number); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description:
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="4"><?= htmlspecialchars($roomData->description); ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price_per_night">
                Price Per Night:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price_per_night" type="number" step="0.01" name="price_per_night" value="<?= htmlspecialchars($roomData->price_per_night); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="room_type">
                Room Type:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="room_type" type="text" name="room_type" value="<?= htmlspecialchars($roomData->room_type); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                Room Image:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" type="file" name="image[]" accept="image/*" multiple>
            <?php if (!empty($roomData->image_url)): ?>
                <p class="text-sm text-gray-700 mt-2">Current images:</p>
                <div class="flex flex-wrap gap-2 mt-1">
                    <?php foreach ($roomData->image_url as $index => $img_url): ?>
                        <div class="relative w-24 h-24">
                            <img src="<?= htmlspecialchars($img_url); ?>" alt="Room Image" class="w-full h-full object-cover rounded-md border border-gray-300">
                            <button type="button" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold" onclick="deleteImage('<?= htmlspecialchars($roomData->id); ?>', '<?= $index; ?>')">
                                X
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Availability:
            </label>
            <input type="checkbox" id="is_available" name="is_available" value="1" <?= ($roomData->is_available == 1) ? 'checked' : ''; ?>>
            <label for="is_available" class="ml-2 text-gray-700">Available</label>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Update Room
            </button>
            <a href="/app1/public/admin/dashboard" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
function deleteImage(roomId, imageIndex) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch('/app1/public/admin/deleteRoomImage', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ room_id: roomId, image_index: imageIndex })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Image deleted successfully!');
                location.reload(); // Reload the page to reflect changes
            } else {
                alert('Error deleting image: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the image.');
        });
    }
}
</script>