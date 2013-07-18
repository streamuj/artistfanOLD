<?php


/**
 * Base class that represents a query for the 'music_purchase' table.
 *
 * 
 *
 * @method     MusicPurchaseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MusicPurchaseQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     MusicPurchaseQuery orderByMusicId($order = Criteria::ASC) Order by the music_id column
 * @method     MusicPurchaseQuery orderByWithAllAlbum($order = Criteria::ASC) Order by the with_all_album column
 * @method     MusicPurchaseQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     MusicPurchaseQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     MusicPurchaseQuery groupById() Group by the id column
 * @method     MusicPurchaseQuery groupByUserId() Group by the user_id column
 * @method     MusicPurchaseQuery groupByMusicId() Group by the music_id column
 * @method     MusicPurchaseQuery groupByWithAllAlbum() Group by the with_all_album column
 * @method     MusicPurchaseQuery groupByPrice() Group by the price column
 * @method     MusicPurchaseQuery groupByPdate() Group by the pdate column
 *
 * @method     MusicPurchaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MusicPurchaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MusicPurchaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MusicPurchaseQuery leftJoinMusic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Music relation
 * @method     MusicPurchaseQuery rightJoinMusic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Music relation
 * @method     MusicPurchaseQuery innerJoinMusic($relationAlias = null) Adds a INNER JOIN clause to the query using the Music relation
 *
 * @method     MusicPurchaseQuery leftJoinMusicRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the MusicRelatedById relation
 * @method     MusicPurchaseQuery rightJoinMusicRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MusicRelatedById relation
 * @method     MusicPurchaseQuery innerJoinMusicRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the MusicRelatedById relation
 *
 * @method     MusicPurchase findOne(PropelPDO $con = null) Return the first MusicPurchase matching the query
 * @method     MusicPurchase findOneOrCreate(PropelPDO $con = null) Return the first MusicPurchase matching the query, or a new MusicPurchase object populated from the query conditions when no match is found
 *
 * @method     MusicPurchase findOneById(int $id) Return the first MusicPurchase filtered by the id column
 * @method     MusicPurchase findOneByUserId(int $user_id) Return the first MusicPurchase filtered by the user_id column
 * @method     MusicPurchase findOneByMusicId(int $music_id) Return the first MusicPurchase filtered by the music_id column
 * @method     MusicPurchase findOneByWithAllAlbum(int $with_all_album) Return the first MusicPurchase filtered by the with_all_album column
 * @method     MusicPurchase findOneByPrice(double $price) Return the first MusicPurchase filtered by the price column
 * @method     MusicPurchase findOneByPdate(int $pdate) Return the first MusicPurchase filtered by the pdate column
 *
 * @method     array findById(int $id) Return MusicPurchase objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return MusicPurchase objects filtered by the user_id column
 * @method     array findByMusicId(int $music_id) Return MusicPurchase objects filtered by the music_id column
 * @method     array findByWithAllAlbum(int $with_all_album) Return MusicPurchase objects filtered by the with_all_album column
 * @method     array findByPrice(double $price) Return MusicPurchase objects filtered by the price column
 * @method     array findByPdate(int $pdate) Return MusicPurchase objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseMusicPurchaseQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseMusicPurchaseQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'MusicPurchase', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MusicPurchaseQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MusicPurchaseQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MusicPurchaseQuery) {
			return $criteria;
		}
		$query = new MusicPurchaseQuery();
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
	 * @return    MusicPurchase|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = MusicPurchasePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(MusicPurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    MusicPurchase A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `MUSIC_ID`, `WITH_ALL_ALBUM`, `PRICE`,  `IS_DELETE`, `PDATE` FROM `music_purchase` WHERE `ID` = :p0';
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
			$obj = new MusicPurchase();
			$obj->hydrate($row);
			MusicPurchasePeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    MusicPurchase|array|mixed the result, formatted by the current formatter
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
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MusicPurchasePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MusicPurchasePeer::ID, $keys, Criteria::IN);
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
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MusicPurchasePeer::ID, $id, $comparison);
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
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(MusicPurchasePeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(MusicPurchasePeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPurchasePeer::USER_ID, $userId, $comparison);
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
	 * @see       filterByMusic()
	 *
	 * @param     mixed $musicId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByMusicId($musicId = null, $comparison = null)
	{
		if (is_array($musicId)) {
			$useMinMax = false;
			if (isset($musicId['min'])) {
				$this->addUsingAlias(MusicPurchasePeer::MUSIC_ID, $musicId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($musicId['max'])) {
				$this->addUsingAlias(MusicPurchasePeer::MUSIC_ID, $musicId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPurchasePeer::MUSIC_ID, $musicId, $comparison);
	}

	/**
	 * Filter the query on the with_all_album column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByWithAllAlbum(1234); // WHERE with_all_album = 1234
	 * $query->filterByWithAllAlbum(array(12, 34)); // WHERE with_all_album IN (12, 34)
	 * $query->filterByWithAllAlbum(array('min' => 12)); // WHERE with_all_album > 12
	 * </code>
	 *
	 * @param     mixed $withAllAlbum The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByWithAllAlbum($withAllAlbum = null, $comparison = null)
	{
		if (is_array($withAllAlbum)) {
			$useMinMax = false;
			if (isset($withAllAlbum['min'])) {
				$this->addUsingAlias(MusicPurchasePeer::WITH_ALL_ALBUM, $withAllAlbum['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($withAllAlbum['max'])) {
				$this->addUsingAlias(MusicPurchasePeer::WITH_ALL_ALBUM, $withAllAlbum['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPurchasePeer::WITH_ALL_ALBUM, $withAllAlbum, $comparison);
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
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(MusicPurchasePeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(MusicPurchasePeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPurchasePeer::PRICE, $price, $comparison);
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
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(MusicPurchasePeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(MusicPurchasePeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPurchasePeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query by a related Music object
	 *
	 * @param     Music|PropelCollection $music The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByMusic($music, $comparison = null)
	{
		if ($music instanceof Music) {
			return $this
				->addUsingAlias(MusicPurchasePeer::MUSIC_ID, $music->getId(), $comparison);
		} elseif ($music instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MusicPurchasePeer::MUSIC_ID, $music->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByMusic() only accepts arguments of type Music or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Music relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function joinMusic($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Music');

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
			$this->addJoinObject($join, 'Music');
		}

		return $this;
	}

	/**
	 * Use the Music relation Music object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery A secondary query class using the current class as primary query
	 */
	public function useMusicQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinMusic($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Music', 'MusicQuery');
	}

	/**
	 * Filter the query by a related Music object
	 *
	 * @param     Music $music  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function filterByMusicRelatedById($music, $comparison = null)
	{
		if ($music instanceof Music) {
			return $this
				->addUsingAlias(MusicPurchasePeer::MUSIC_ID, $music->getId(), $comparison);
		} elseif ($music instanceof PropelCollection) {
			return $this
				->useMusicRelatedByIdQuery()
				->filterByPrimaryKeys($music->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMusicRelatedById() only accepts arguments of type Music or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MusicRelatedById relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function joinMusicRelatedById($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MusicRelatedById');

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
			$this->addJoinObject($join, 'MusicRelatedById');
		}

		return $this;
	}

	/**
	 * Use the MusicRelatedById relation Music object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery A secondary query class using the current class as primary query
	 */
	public function useMusicRelatedByIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMusicRelatedById($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MusicRelatedById', 'MusicQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MusicPurchase $musicPurchase Object to remove from the list of results
	 *
	 * @return    MusicPurchaseQuery The current query, for fluid interface
	 */
	public function prune($musicPurchase = null)
	{
		if ($musicPurchase) {
			$this->addUsingAlias(MusicPurchasePeer::ID, $musicPurchase->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseMusicPurchaseQuery