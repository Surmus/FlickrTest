<?hh //strict
/**
 * IFlickrRepository.php file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

namespace App\Services;

interface IFlickrRepository {

    /**
     * @param string $tags
     * @return Collection
     * @throws \Exception
     */
    public function getImagesByTags(string $tags): Collection;

    /**
     * @return bool
     */
    public function isCached(): bool;

}