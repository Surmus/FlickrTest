<?hh // strict
/**
 * FlickrCacheableRepository.php file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class FlickrCacheableRepository extends FlickrRepository implements IFlickrRepository
{
    private string $tags;
    private bool $isCached = true;

    /**
     * Checks if the returned Collection is from cache service
     *
     * @return bool
     */
    public function isCached(): bool
    {
        if ($this->tags) {
            return $this->isCached;
        }

        return false;
    }

    /**
     * Retrieves image Collection from repository
     *
     * @param string $tags
     * @return Collection
     */
    public function getImagesByTags(string $tags): Collection
    {
        $this->tags = $tags;
        $images = $this->getImagesFromCache();

        if (!$images || empty($images)) {
            $images = parent::GetImagesByTags($tags);
            $this->isCached = false;
            $this->addToCache($images);
        }

        return $images;
    }

    /**
     * Inserts images Collection into cache service
     *
     * @param Collection $items
     */
    private function addToCache(Collection $items): void
    {
        Cache::forever($this->tags, $items);
    }

    /**
     * Fetches image Collection from cache service
     *
     * @return Collection
     */
    private function getImagesFromCache(): ?Collection
    {
        return Cache::get($this->tags);
    }
}