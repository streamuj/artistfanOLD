<?php


/**
 * Base class that represents a query for the 'photo' table.
 *
 * 
 *
 * @method     PhotoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PhotoQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     PhotoQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     PhotoQuery orderByAlbumId($order = Criteria::ASC) Order by the album_id column
 * @method     PhotoQuery orderByPhotoDate($order = Criteria::ASC) Order by the photo_date column
 * @method     PhotoQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     PhotoQuery orderByIsCover($order = Criteria::ASC) Order by the is_cover column
 * @method     PhotoQuery orderBySlide($order = Criteria::ASC) Order by the slide column
 * @method     PhotoQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     PhotoQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     PhotoQuery groupById() Group by the id column
 * @method     PhotoQuery groupByUserId() Group by the user_id column
 * @method     PhotoQuery groupByTitle() Group by the title column
 * @method     PhotoQuery groupByAlbumId() Group by the album_id column
 * @method     PhotoQuery groupByPhotoDate() Group by the photo_date column
 * @method     PhotoQuery groupByImage() Group by the image column
 * @method     PhotoQuery groupByIsCover() Group by the is_cover column
 * @method     PhotoQuery groupBySlide() Group by the slide column
 * @method     PhotoQuery groupByPrice() Group by the price column
 * @method     PhotoQuery groupByPdate() Group by the pdate column
 *
 * @method     PhotoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PhotoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PhotoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PhotoQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     PhotoQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     PhotoQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     PhotoQuery leftJoinPhotoAlbum($relationAlias = null) Adds a LEFT JOIN clause to the query using the PhotoAlbum relation
 * @method     PhotoQuery rightJoinPhotoAlbum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PhotoAlbum relation
 * @method     PhotoQuery innerJoinPhotoAlbum($relationAlias = null) Adds a INNER JOIN clause to the query using the PhotoAlbum relation
 *
 * @method     Photo findOne(PropelPDO $con = null) Return the first Photo matching the query
 * @method     Photo findOneOrCreate(PropelPDO $con = null) Return the first Photo matching the query, or a new Photo object populated from the query conditions when no match is found
 *
 * @method     Photo findOneById(int $id) Return the first Photo filtered by the id column
 * @method     Photo findOneByUserId(int $user_id) Return the first Photo filtered by the user_id column
 * @method     Photo findOneByTitle(string $title) Return the first Photo filtered by the title column
 * @method     Photo findOneByAlbumId(int $album_id) Return the first Photo filtered by the album_id column
 * @method     Photo findOneByPhotoDate(string $photo_date) Return the first Photo filtered by the photo_date column
 * @method     Photo findOneByImage(string $image) Return the first Photo filtered by the image column
 * @method     Photo findOneByIsCover(int $is_cover) Return the first Photo filtered by the is_cover column
 * @method     Photo findOneBySlide(int $slide) Return the first Photo filtered by the slide column
 * @method     Photo findOneByPrice(double $price) Return the first Photo filtered by the price column
 * @method     Photo findOneByPdate(int $pdate) Return the first Photo filtered by the pdate column
 *
 * @method     array findById(int $id) Return Photo objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Photo objects filtered by the user_id column
 * @method     array findByTitle(string $title) Return Photo objects filtered by the title column
 * @method     array findByAlbumId(int $album_id) Return Photo objects filtered by the album_id column
 * @method     array findByPhotoDate(string $photo_date) Return Photo objects filtered by the photo_date column
 * @method     array findByImage(string $image) Return Photo objects filtered by the image column
 * @method     array findByIsCover(int $is_cover) Return Photo objects filtered by the is_cover column
 * @method     array findBySlide(int $slide) Return Photo objects filtered by the slide column
 * @method     array findByPrice(double $price) Return Photo objects filtered by the price column
 * @method     array findByPdate(int $pdate) Return Photo objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePhotoQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePhotoQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Photo', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PhotoQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PhotoQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PhotoQuery) {
			return $criteria;
		}
		$query = new PhotoQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Photo|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PhotoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PhotoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Photo A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `TITLE`, `ALBUM_ID`, `PHOTO_DATE`, `IMAGE`, `IS_COVER`, `SLIDE`, `PRICE`, `PDATE`, `LINK`, `IS_NEW`, `WALL_ID`  FROM `photo` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Photo();
			$obj->hydrate($row);
			PhotoPeer::addInstanceToPool($obj, (string) $key);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Photo|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PhotoPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PhotoPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PhotoPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(PhotoPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(PhotoPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the title column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PhotoPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the album_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAlbumId(1234); // WHERE album_id = 1234
	 * $query->filterByAlbumId(array(12, 34)); // WHERE album_id IN (12, 34)
	 * $query->filterByAlbumId(array('min' => 12)); // WHERE album_id > 12
	 * </code>
	 *
	 * @see       filterByPhotoAlbum()
	 *
	 * @param     mixed $albumId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByAlbumId($albumId = null, $comparison = null)
	{
		if (is_array($albumId)) {
			$useMinMax = false;
			if (isset($albumId['min'])) {
				$this->addUsingAlias(PhotoPeer::ALBUM_ID, $albumId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($albumId['max'])) {
				$this->addUsingAlias(PhotoPeer::ALBUM_ID, $albumId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::ALBUM_ID, $albumId, $comparison);
	}

	/**
	 * Filter the query on the photo_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPhotoDate('2011-03-14'); // WHERE photo_date = '2011-03-14'
	 * $query->filterByPhotoDate('now'); // WHERE photo_date = '2011-03-14'
	 * $query->filterByPhotoDate(array('max' => 'yesterday')); // WHERE photo_date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $photoDate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByPhotoDate($photoDate = null, $comparison = null)
	{
		if (is_array($photoDate)) {
			$useMinMax = false;
			if (isset($photoDate['min'])) {
				$this->addUsingAlias(PhotoPeer::PHOTO_DATE, $photoDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($photoDate['max'])) {
				$this->addUsingAlias(PhotoPeer::PHOTO_DATE, $photoDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::PHOTO_DATE, $photoDate, $comparison);
	}

	/**
	 * Filter the query on the image column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
	 * $query->filterByImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $image The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByImage($image = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($image)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $image)) {
				$image = str_replace('*', '%', $image);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PhotoPeer::IMAGE, $image, $comparison);
	}

	/**
	 * Filter the query on the is_cover column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsCover(1234); // WHERE is_cover = 1234
	 * $query->filterByIsCover(array(12, 34)); // WHERE is_cover IN (12, 34)
	 * $query->filterByIsCover(array('min' => 12)); // WHERE is_cover > 12
	 * </code>
	 *
	 * @param     mixed $isCover The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByIsCover($isCover = null, $comparison = null)
	{
		if (is_array($isCover)) {
			$useMinMax = false;
			if (isset($isCover['min'])) {
				$this->addUsingAlias(PhotoPeer::IS_COVER, $isCover['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isCover['max'])) {
				$this->addUsingAlias(PhotoPeer::IS_COVER, $isCover['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::IS_COVER, $isCover, $comparison);
	}

	/**
	 * Filter the query on the slide column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySlide(1234); // WHERE slide = 1234
	 * $query->filterBySlide(array(12, 34)); // WHERE slide IN (12, 34)
	 * $query->filterBySlide(array('min' => 12)); // WHERE slide > 12
	 * </code>
	 *
	 * @param     mixed $slide The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterBySlide($slide = null, $comparison = null)
	{
		if (is_array($slide)) {
			$useMinMax = false;
			if (isset($slide['min'])) {
				$this->addUsingAlias(PhotoPeer::SLIDE, $slide['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($slide['max'])) {
				$this->addUsingAlias(PhotoPeer::SLIDE, $slide['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::SLIDE, $slide, $comparison);
	}

	/**
	 * Filter the query on the price column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPrice(1234); // WHERE price = 1234
	 * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
	 * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
	 * </code>
	 *
	 * @param     mixed $price The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(PhotoPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(PhotoPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the pdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPdate(1234); // WHERE pdate = 1234
	 * $query->filterByPdate(array(12, 34)); // WHERE pdate IN (12, 34)
	 * $query->filterByPdate(array('min' => 12)); // WHERE pdate > 12
	 * </code>
	 *
	 * @param     mixed $pdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(PhotoPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(PhotoPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::PDATE, $pdate, $comparison);
	}
	
	/**
	 * Filter the query on the link column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLink('fooValue');   // WHERE link = 'fooValue'
	 * $query->filterByLink('%fooValue%'); // WHERE link LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $link The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByLink($link = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($link)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $link)) {
				$link = str_replace('*', '%', $link);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PhotoPeer::LINK, $link, $comparison);
	}
	
	/**
	 * Filter the query on the is_new column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsNew(1234); // WHERE is_new = 1234
	 * $query->filterByIsNew(array(12, 34)); // WHERE is_new IN (12, 34)
	 * $query->filterByIsNew(array('min' => 12)); // WHERE is_new > 12
	 * </code>
	 *
	 * @param     mixed $isNew The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByIsNew($isNew = null, $comparison = null)
	{
		if (is_array($isNew)) {
			$useMinMax = false;
			if (isset($isNew['min'])) {
				$this->addUsingAlias(PhotoPeer::IS_NEW, $isNew['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isNew['max'])) {
				$this->addUsingAlias(PhotoPeer::IS_NEW, $isNew['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::IS_NEW, $isNew, $comparison);
	}

	/**
	 * Filter the query on the wall_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByWallId(1234); // WHERE wall_id = 1234
	 * $query->filterByWallId(array(12, 34)); // WHERE wall_id IN (12, 34)
	 * $query->filterByWallId(array('min' => 12)); // WHERE wall_id > 12
	 * </code>
	 *
	 * @param     mixed $wallId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByWallId($wallId = null, $comparison = null)
	{
		if (is_array($wallId)) {
			$useMinMax = false;
			if (isset($wallId['min'])) {
				$this->addUsingAlias(PhotoPeer::WALL_ID, $wallId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($wallId['max'])) {
				$this->addUsingAlias(PhotoPeer::WALL_ID, $wallId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPeer::WALL_ID, $wallId, $comparison);
	}

	
	

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(PhotoPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PhotoPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'User');
		}

		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related PhotoAlbum object
	 *
	 * @param     PhotoAlbum|PropelCollection $photoAlbum The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function filterByPhotoAlbum($photoAlbum, $comparison = null)
	{
		if ($photoAlbum instanceof PhotoAlbum) {
			return $this
				->addUsingAlias(PhotoPeer::ALBUM_ID, $photoAlbum->getId(), $comparison);
		} elseif ($photoAlbum instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PhotoPeer::ALBUM_ID, $photoAlbum->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByPhotoAlbum() only accepts arguments of type PhotoAlbum or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the PhotoAlbum relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function joinPhotoAlbum($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PhotoAlbum');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'PhotoAlbum');
		}

		return $this;
	}

	/**
	 * Use the PhotoAlbum relation PhotoAlbum object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoAlbumQuery A secondary query class using the current class as primary query
	 */
	public function usePhotoAlbumQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPhotoAlbum($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PhotoAlbum', 'PhotoAlbumQuery');
	}
	/**
	 * Exclude object from result
	 *
	 * @param     Photo $photo Object to remove from the list of results
	 *
	 * @return    PhotoQuery The current query, for fluid interface
	 */
	public function prune($photo = null)
	{
		if ($photo) {
			$this->addUsingAlias(PhotoPeer::ID, $photo->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePhotoQuery