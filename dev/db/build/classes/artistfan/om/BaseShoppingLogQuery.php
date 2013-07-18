<?php


/**
 * Base class that represents a query for the 'shopping_log' table.
 *
 * 
 *
 * @method     ShoppingLogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ShoppingLogQuery orderByWallId($order = Criteria::ASC) Order by the wall_id column
 * @method     ShoppingLogQuery orderByArtistId($order = Criteria::ASC) Order by the artist_id column
 * @method     ShoppingLogQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ShoppingLogQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method     ShoppingLogQuery orderByMoney($order = Criteria::ASC) Order by the money column
 * @method     ShoppingLogQuery orderByAlbumId($order = Criteria::ASC) Order by the album_id column
 * @method     ShoppingLogQuery orderByMusicId($order = Criteria::ASC) Order by the music_id column
 * @method     ShoppingLogQuery orderByVideoId($order = Criteria::ASC) Order by the video_id column
 * @method     ShoppingLogQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     ShoppingLogQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ShoppingLogQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     ShoppingLogQuery groupById() Group by the id column
 * @method     ShoppingLogQuery groupByWallId() Group by the wall_id column
 * @method     ShoppingLogQuery groupByArtistId() Group by the artist_id column
 * @method     ShoppingLogQuery groupByUserId() Group by the user_id column
 * @method     ShoppingLogQuery groupByAction() Group by the action column
 * @method     ShoppingLogQuery groupByMoney() Group by the money column
 * @method     ShoppingLogQuery groupByAlbumId() Group by the album_id column
 * @method     ShoppingLogQuery groupByMusicId() Group by the music_id column
 * @method     ShoppingLogQuery groupByVideoId() Group by the video_id column
 * @method     ShoppingLogQuery groupByEventId() Group by the event_id column
 * @method     ShoppingLogQuery groupByData() Group by the data column
 * @method     ShoppingLogQuery groupByPdate() Group by the pdate column
 *
 * @method     ShoppingLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ShoppingLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ShoppingLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ShoppingLogQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ShoppingLogQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ShoppingLogQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ShoppingLog findOne(PropelPDO $con = null) Return the first ShoppingLog matching the query
 * @method     ShoppingLog findOneOrCreate(PropelPDO $con = null) Return the first ShoppingLog matching the query, or a new ShoppingLog object populated from the query conditions when no match is found
 *
 * @method     ShoppingLog findOneById(int $id) Return the first ShoppingLog filtered by the id column
 * @method     ShoppingLog findOneByWallId(int $wall_id) Return the first ShoppingLog filtered by the wall_id column
 * @method     ShoppingLog findOneByArtistId(int $artist_id) Return the first ShoppingLog filtered by the artist_id column
 * @method     ShoppingLog findOneByUserId(int $user_id) Return the first ShoppingLog filtered by the user_id column
 * @method     ShoppingLog findOneByAction(string $action) Return the first ShoppingLog filtered by the action column
 * @method     ShoppingLog findOneByMoney(double $money) Return the first ShoppingLog filtered by the money column
 * @method     ShoppingLog findOneByAlbumId(int $album_id) Return the first ShoppingLog filtered by the album_id column
 * @method     ShoppingLog findOneByMusicId(int $music_id) Return the first ShoppingLog filtered by the music_id column
 * @method     ShoppingLog findOneByVideoId(int $video_id) Return the first ShoppingLog filtered by the video_id column
 * @method     ShoppingLog findOneByEventId(int $event_id) Return the first ShoppingLog filtered by the event_id column
 * @method     ShoppingLog findOneByData(string $data) Return the first ShoppingLog filtered by the data column
 * @method     ShoppingLog findOneByPdate(int $pdate) Return the first ShoppingLog filtered by the pdate column
 *
 * @method     array findById(int $id) Return ShoppingLog objects filtered by the id column
 * @method     array findByWallId(int $wall_id) Return ShoppingLog objects filtered by the wall_id column
 * @method     array findByArtistId(int $artist_id) Return ShoppingLog objects filtered by the artist_id column
 * @method     array findByUserId(int $user_id) Return ShoppingLog objects filtered by the user_id column
 * @method     array findByAction(string $action) Return ShoppingLog objects filtered by the action column
 * @method     array findByMoney(double $money) Return ShoppingLog objects filtered by the money column
 * @method     array findByAlbumId(int $album_id) Return ShoppingLog objects filtered by the album_id column
 * @method     array findByMusicId(int $music_id) Return ShoppingLog objects filtered by the music_id column
 * @method     array findByVideoId(int $video_id) Return ShoppingLog objects filtered by the video_id column
 * @method     array findByEventId(int $event_id) Return ShoppingLog objects filtered by the event_id column
 * @method     array findByData(string $data) Return ShoppingLog objects filtered by the data column
 * @method     array findByPdate(int $pdate) Return ShoppingLog objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseShoppingLogQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseShoppingLogQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'ShoppingLog', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ShoppingLogQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ShoppingLogQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ShoppingLogQuery) {
			return $criteria;
		}
		$query = new ShoppingLogQuery();
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
	 * @return    ShoppingLog|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ShoppingLogPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ShoppingLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ShoppingLog A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `WALL_ID`, `ARTIST_ID`, `USER_ID`, `ACTION`, `MONEY`, `ALBUM_ID`, `MUSIC_ID`, `VIDEO_ID`, `EVENT_ID`, `DATA`, `PDATE` FROM `shopping_log` WHERE `ID` = :p0';
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
			$obj = new ShoppingLog();
			$obj->hydrate($row);
			ShoppingLogPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    ShoppingLog|array|mixed the result, formatted by the current formatter
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ShoppingLogPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ShoppingLogPeer::ID, $keys, Criteria::IN);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ShoppingLogPeer::ID, $id, $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByWallId($wallId = null, $comparison = null)
	{
		if (is_array($wallId)) {
			$useMinMax = false;
			if (isset($wallId['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::WALL_ID, $wallId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($wallId['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::WALL_ID, $wallId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::WALL_ID, $wallId, $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByArtistId($artistId = null, $comparison = null)
	{
		if (is_array($artistId)) {
			$useMinMax = false;
			if (isset($artistId['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::ARTIST_ID, $artistId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artistId['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::ARTIST_ID, $artistId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::ARTIST_ID, $artistId, $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the action column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
	 * $query->filterByAction('%fooValue%'); // WHERE action LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $action The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByAction($action = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($action)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $action)) {
				$action = str_replace('*', '%', $action);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::ACTION, $action, $comparison);
	}

	/**
	 * Filter the query on the money column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMoney(1234); // WHERE money = 1234
	 * $query->filterByMoney(array(12, 34)); // WHERE money IN (12, 34)
	 * $query->filterByMoney(array('min' => 12)); // WHERE money > 12
	 * </code>
	 *
	 * @param     mixed $money The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByMoney($money = null, $comparison = null)
	{
		if (is_array($money)) {
			$useMinMax = false;
			if (isset($money['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::MONEY, $money['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($money['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::MONEY, $money['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::MONEY, $money, $comparison);
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
	 * @param     mixed $albumId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByAlbumId($albumId = null, $comparison = null)
	{
		if (is_array($albumId)) {
			$useMinMax = false;
			if (isset($albumId['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::ALBUM_ID, $albumId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($albumId['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::ALBUM_ID, $albumId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::ALBUM_ID, $albumId, $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByMusicId($musicId = null, $comparison = null)
	{
		if (is_array($musicId)) {
			$useMinMax = false;
			if (isset($musicId['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::MUSIC_ID, $musicId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($musicId['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::MUSIC_ID, $musicId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::MUSIC_ID, $musicId, $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByVideoId($videoId = null, $comparison = null)
	{
		if (is_array($videoId)) {
			$useMinMax = false;
			if (isset($videoId['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::VIDEO_ID, $videoId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($videoId['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::VIDEO_ID, $videoId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::VIDEO_ID, $videoId, $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId)) {
			$useMinMax = false;
			if (isset($eventId['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventId['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::EVENT_ID, $eventId, $comparison);
	}

	/**
	 * Filter the query on the data column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByData('fooValue');   // WHERE data = 'fooValue'
	 * $query->filterByData('%fooValue%'); // WHERE data LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $data The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByData($data = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($data)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $data)) {
				$data = str_replace('*', '%', $data);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::DATA, $data, $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(ShoppingLogPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(ShoppingLogPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShoppingLogPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(ShoppingLogPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ShoppingLogPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ShoppingLogQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     ShoppingLog $shoppingLog Object to remove from the list of results
	 *
	 * @return    ShoppingLogQuery The current query, for fluid interface
	 */
	public function prune($shoppingLog = null)
	{
		if ($shoppingLog) {
			$this->addUsingAlias(ShoppingLogPeer::ID, $shoppingLog->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseShoppingLogQuery