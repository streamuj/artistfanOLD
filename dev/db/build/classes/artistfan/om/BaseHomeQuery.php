<?php


/**
 * Base class that represents a query for the 'home' table.
 *
 * 
 *
 * @method     HomeQuery orderByHomeId($order = Criteria::ASC) Order by the home_id column
 * @method     HomeQuery orderByArtistId($order = Criteria::ASC) Order by the artist_id column
 * @method     HomeQuery orderByVideoId($order = Criteria::ASC) Order by the video_id column
 * @method     HomeQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     HomeQuery orderByMusicId($order = Criteria::ASC) Order by the music_id column
 * @method     HomeQuery orderByMusicAlbumId($order = Criteria::ASC) Order by the music_album_id column
 * @method     HomeQuery orderByLink($order = Criteria::ASC) Order by the link column
 * @method     HomeQuery orderByHomeOrder($order = Criteria::ASC) Order by the home_order column
 * @method     HomeQuery orderByCdate($order = Criteria::ASC) Order by the cdate column
 * @method     HomeQuery orderByMdate($order = Criteria::ASC) Order by the mdate column
 * @method     HomeQuery orderByHomeCat($order = Criteria::ASC) Order by the home_cat column
 * @method     HomeQuery orderByImagePath($order = Criteria::ASC) Order by the image_path column
 *
 * @method     HomeQuery groupByHomeId() Group by the home_id column
 * @method     HomeQuery groupByArtistId() Group by the artist_id column
 * @method     HomeQuery groupByVideoId() Group by the video_id column
 * @method     HomeQuery groupByEventId() Group by the event_id column
 * @method     HomeQuery groupByMusicId() Group by the music_id column
 * @method     HomeQuery groupByMusicAlbumId() Group by the music_album_id column
 * @method     HomeQuery groupByLink() Group by the link column
 * @method     HomeQuery groupByHomeOrder() Group by the home_order column
 * @method     HomeQuery groupByCdate() Group by the cdate column
 * @method     HomeQuery groupByMdate() Group by the mdate column
 * @method     HomeQuery groupByHomeCat() Group by the home_cat column
 * @method     HomeQuery groupByImagePath() Group by the image_path column
 *
 * @method     HomeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     HomeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     HomeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Home findOne(PropelPDO $con = null) Return the first Home matching the query
 * @method     Home findOneOrCreate(PropelPDO $con = null) Return the first Home matching the query, or a new Home object populated from the query conditions when no match is found
 *
 * @method     Home findOneByHomeId(int $home_id) Return the first Home filtered by the home_id column
 * @method     Home findOneByArtistId(int $artist_id) Return the first Home filtered by the artist_id column
 * @method     Home findOneByVideoId(int $video_id) Return the first Home filtered by the video_id column
 * @method     Home findOneByEventId(int $event_id) Return the first Home filtered by the event_id column
 * @method     Home findOneByMusicId(int $music_id) Return the first Home filtered by the music_id column
 * @method     Home findOneByMusicAlbumId(int $music_album_id) Return the first Home filtered by the music_album_id column
 * @method     Home findOneByLink(string $link) Return the first Home filtered by the link column
 * @method     Home findOneByHomeOrder(int $home_order) Return the first Home filtered by the home_order column
 * @method     Home findOneByCdate(int $cdate) Return the first Home filtered by the cdate column
 * @method     Home findOneByMdate(int $mdate) Return the first Home filtered by the mdate column
 * @method     Home findOneByHomeCat(int $home_cat) Return the first Home filtered by the home_cat column
 * @method     Home findOneByImagePath(string $image_path) Return the first Home filtered by the image_path column
 *
 * @method     array findByHomeId(int $home_id) Return Home objects filtered by the home_id column
 * @method     array findByArtistId(int $artist_id) Return Home objects filtered by the artist_id column
 * @method     array findByVideoId(int $video_id) Return Home objects filtered by the video_id column
 * @method     array findByEventId(int $event_id) Return Home objects filtered by the event_id column
 * @method     array findByMusicId(int $music_id) Return Home objects filtered by the music_id column
 * @method     array findByMusicAlbumId(int $music_album_id) Return Home objects filtered by the music_album_id column
 * @method     array findByLink(string $link) Return Home objects filtered by the link column
 * @method     array findByHomeOrder(int $home_order) Return Home objects filtered by the home_order column
 * @method     array findByCdate(int $cdate) Return Home objects filtered by the cdate column
 * @method     array findByMdate(int $mdate) Return Home objects filtered by the mdate column
 * @method     array findByHomeCat(int $home_cat) Return Home objects filtered by the home_cat column
 * @method     array findByImagePath(string $image_path) Return Home objects filtered by the image_path column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseHomeQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseHomeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Home', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new HomeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    HomeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof HomeQuery) {
			return $criteria;
		}
		$query = new HomeQuery();
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
	 * @return    Home|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = HomePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(HomePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Home A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `HOME_ID`, `ARTIST_ID`, `VIDEO_ID`, `EVENT_ID`, `MUSIC_ID`, `MUSIC_ALBUM_ID`, `LINK`, `HOME_ORDER`, `CDATE`, `MDATE`, `HOME_CAT`, `IMAGE_PATH` FROM `home` WHERE `HOME_ID` = :p0';
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
			$obj = new Home();
			$obj->hydrate($row);
			HomePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Home|array|mixed the result, formatted by the current formatter
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
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(HomePeer::HOME_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(HomePeer::HOME_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the home_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHomeId(1234); // WHERE home_id = 1234
	 * $query->filterByHomeId(array(12, 34)); // WHERE home_id IN (12, 34)
	 * $query->filterByHomeId(array('min' => 12)); // WHERE home_id > 12
	 * </code>
	 *
	 * @param     mixed $homeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByHomeId($homeId = null, $comparison = null)
	{
		if (is_array($homeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(HomePeer::HOME_ID, $homeId, $comparison);
	}

	/**
	 * Filter the query on the artist_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtistId(1234); // WHERE artist_id = 1234
	 * $query->filterByArtistId(array(12, 34)); // WHERE artist_id IN (12, 34)
	 * $query->filterByArtistId(array('min' => 12)); // WHERE artist_id > 12
	 * </code>
	 *
	 * @param     mixed $artistId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByArtistId($artistId = null, $comparison = null)
	{
		if (is_array($artistId)) {
			$useMinMax = false;
			if (isset($artistId['min'])) {
				$this->addUsingAlias(HomePeer::ARTIST_ID, $artistId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artistId['max'])) {
				$this->addUsingAlias(HomePeer::ARTIST_ID, $artistId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::ARTIST_ID, $artistId, $comparison);
	}

	/**
	 * Filter the query on the video_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideoId(1234); // WHERE video_id = 1234
	 * $query->filterByVideoId(array(12, 34)); // WHERE video_id IN (12, 34)
	 * $query->filterByVideoId(array('min' => 12)); // WHERE video_id > 12
	 * </code>
	 *
	 * @param     mixed $videoId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByVideoId($videoId = null, $comparison = null)
	{
		if (is_array($videoId)) {
			$useMinMax = false;
			if (isset($videoId['min'])) {
				$this->addUsingAlias(HomePeer::VIDEO_ID, $videoId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($videoId['max'])) {
				$this->addUsingAlias(HomePeer::VIDEO_ID, $videoId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::VIDEO_ID, $videoId, $comparison);
	}

	/**
	 * Filter the query on the event_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventId(1234); // WHERE event_id = 1234
	 * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
	 * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
	 * </code>
	 *
	 * @param     mixed $eventId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId)) {
			$useMinMax = false;
			if (isset($eventId['min'])) {
				$this->addUsingAlias(HomePeer::EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventId['max'])) {
				$this->addUsingAlias(HomePeer::EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::EVENT_ID, $eventId, $comparison);
	}

	/**
	 * Filter the query on the music_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMusicId(1234); // WHERE music_id = 1234
	 * $query->filterByMusicId(array(12, 34)); // WHERE music_id IN (12, 34)
	 * $query->filterByMusicId(array('min' => 12)); // WHERE music_id > 12
	 * </code>
	 *
	 * @param     mixed $musicId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByMusicId($musicId = null, $comparison = null)
	{
		if (is_array($musicId)) {
			$useMinMax = false;
			if (isset($musicId['min'])) {
				$this->addUsingAlias(HomePeer::MUSIC_ID, $musicId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($musicId['max'])) {
				$this->addUsingAlias(HomePeer::MUSIC_ID, $musicId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::MUSIC_ID, $musicId, $comparison);
	}

	/**
	 * Filter the query on the music_album_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMusicAlbumId(1234); // WHERE music_album_id = 1234
	 * $query->filterByMusicAlbumId(array(12, 34)); // WHERE music_album_id IN (12, 34)
	 * $query->filterByMusicAlbumId(array('min' => 12)); // WHERE music_album_id > 12
	 * </code>
	 *
	 * @param     mixed $musicAlbumId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByMusicAlbumId($musicAlbumId = null, $comparison = null)
	{
		if (is_array($musicAlbumId)) {
			$useMinMax = false;
			if (isset($musicAlbumId['min'])) {
				$this->addUsingAlias(HomePeer::MUSIC_ALBUM_ID, $musicAlbumId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($musicAlbumId['max'])) {
				$this->addUsingAlias(HomePeer::MUSIC_ALBUM_ID, $musicAlbumId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::MUSIC_ALBUM_ID, $musicAlbumId, $comparison);
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
	 * @return    HomeQuery The current query, for fluid interface
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
		return $this->addUsingAlias(HomePeer::LINK, $link, $comparison);
	}

	/**
	 * Filter the query on the home_order column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHomeOrder(1234); // WHERE home_order = 1234
	 * $query->filterByHomeOrder(array(12, 34)); // WHERE home_order IN (12, 34)
	 * $query->filterByHomeOrder(array('min' => 12)); // WHERE home_order > 12
	 * </code>
	 *
	 * @param     mixed $homeOrder The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByHomeOrder($homeOrder = null, $comparison = null)
	{
		if (is_array($homeOrder)) {
			$useMinMax = false;
			if (isset($homeOrder['min'])) {
				$this->addUsingAlias(HomePeer::HOME_ORDER, $homeOrder['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($homeOrder['max'])) {
				$this->addUsingAlias(HomePeer::HOME_ORDER, $homeOrder['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::HOME_ORDER, $homeOrder, $comparison);
	}

	/**
	 * Filter the query on the cdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCdate(1234); // WHERE cdate = 1234
	 * $query->filterByCdate(array(12, 34)); // WHERE cdate IN (12, 34)
	 * $query->filterByCdate(array('min' => 12)); // WHERE cdate > 12
	 * </code>
	 *
	 * @param     mixed $cdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByCdate($cdate = null, $comparison = null)
	{
		if (is_array($cdate)) {
			$useMinMax = false;
			if (isset($cdate['min'])) {
				$this->addUsingAlias(HomePeer::CDATE, $cdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cdate['max'])) {
				$this->addUsingAlias(HomePeer::CDATE, $cdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::CDATE, $cdate, $comparison);
	}

	/**
	 * Filter the query on the mdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMdate(1234); // WHERE mdate = 1234
	 * $query->filterByMdate(array(12, 34)); // WHERE mdate IN (12, 34)
	 * $query->filterByMdate(array('min' => 12)); // WHERE mdate > 12
	 * </code>
	 *
	 * @param     mixed $mdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByMdate($mdate = null, $comparison = null)
	{
		if (is_array($mdate)) {
			$useMinMax = false;
			if (isset($mdate['min'])) {
				$this->addUsingAlias(HomePeer::MDATE, $mdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($mdate['max'])) {
				$this->addUsingAlias(HomePeer::MDATE, $mdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::MDATE, $mdate, $comparison);
	}

	/**
	 * Filter the query on the home_cat column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHomeCat(1234); // WHERE home_cat = 1234
	 * $query->filterByHomeCat(array(12, 34)); // WHERE home_cat IN (12, 34)
	 * $query->filterByHomeCat(array('min' => 12)); // WHERE home_cat > 12
	 * </code>
	 *
	 * @param     mixed $homeCat The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByHomeCat($homeCat = null, $comparison = null)
	{
		if (is_array($homeCat)) {
			$useMinMax = false;
			if (isset($homeCat['min'])) {
				$this->addUsingAlias(HomePeer::HOME_CAT, $homeCat['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($homeCat['max'])) {
				$this->addUsingAlias(HomePeer::HOME_CAT, $homeCat['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomePeer::HOME_CAT, $homeCat, $comparison);
	}

	/**
	 * Filter the query on the image_path column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByImagePath('fooValue');   // WHERE image_path = 'fooValue'
	 * $query->filterByImagePath('%fooValue%'); // WHERE image_path LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $imagePath The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function filterByImagePath($imagePath = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($imagePath)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $imagePath)) {
				$imagePath = str_replace('*', '%', $imagePath);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(HomePeer::IMAGE_PATH, $imagePath, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Home $home Object to remove from the list of results
	 *
	 * @return    HomeQuery The current query, for fluid interface
	 */
	public function prune($home = null)
	{
		if ($home) {
			$this->addUsingAlias(HomePeer::HOME_ID, $home->getHomeId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseHomeQuery