<?php


/**
 * Base class that represents a query for the 'photo_album' table.
 *
 * 
 *
 * @method     PhotoAlbumQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PhotoAlbumQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     PhotoAlbumQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     PhotoAlbumQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     PhotoAlbumQuery groupById() Group by the id column
 * @method     PhotoAlbumQuery groupByUserId() Group by the user_id column
 * @method     PhotoAlbumQuery groupByTitle() Group by the title column
 * @method     PhotoAlbumQuery groupByPdate() Group by the pdate column
 *
 * @method     PhotoAlbumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PhotoAlbumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PhotoAlbumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PhotoAlbumQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     PhotoAlbumQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     PhotoAlbumQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     PhotoAlbumQuery leftJoinPhoto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Photo relation
 * @method     PhotoAlbumQuery rightJoinPhoto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Photo relation
 * @method     PhotoAlbumQuery innerJoinPhoto($relationAlias = null) Adds a INNER JOIN clause to the query using the Photo relation
 *
 * @method     PhotoAlbum findOne(PropelPDO $con = null) Return the first PhotoAlbum matching the query
 * @method     PhotoAlbum findOneOrCreate(PropelPDO $con = null) Return the first PhotoAlbum matching the query, or a new PhotoAlbum object populated from the query conditions when no match is found
 *
 * @method     PhotoAlbum findOneById(int $id) Return the first PhotoAlbum filtered by the id column
 * @method     PhotoAlbum findOneByUserId(int $user_id) Return the first PhotoAlbum filtered by the user_id column
 * @method     PhotoAlbum findOneByTitle(string $title) Return the first PhotoAlbum filtered by the title column
 * @method     PhotoAlbum findOneByPdate(int $pdate) Return the first PhotoAlbum filtered by the pdate column
 *
 * @method     array findById(int $id) Return PhotoAlbum objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return PhotoAlbum objects filtered by the user_id column
 * @method     array findByTitle(string $title) Return PhotoAlbum objects filtered by the title column
 * @method     array findByPdate(int $pdate) Return PhotoAlbum objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePhotoAlbumQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePhotoAlbumQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'PhotoAlbum', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PhotoAlbumQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PhotoAlbumQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PhotoAlbumQuery) {
			return $criteria;
		}
		$query = new PhotoAlbumQuery();
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
	 * @return    PhotoAlbum|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PhotoAlbumPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PhotoAlbumPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    PhotoAlbum A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `TITLE`, `PDATE` FROM `photo_album` WHERE `ID` = :p0';
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
			$obj = new PhotoAlbum();
			$obj->hydrate($row);
			PhotoAlbumPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    PhotoAlbum|array|mixed the result, formatted by the current formatter
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
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PhotoAlbumPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PhotoAlbumPeer::ID, $keys, Criteria::IN);
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
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PhotoAlbumPeer::ID, $id, $comparison);
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
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(PhotoAlbumPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(PhotoAlbumPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoAlbumPeer::USER_ID, $userId, $comparison);
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
	 * @return    PhotoAlbumQuery The current query, for fluid interface
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
		return $this->addUsingAlias(PhotoAlbumPeer::TITLE, $title, $comparison);
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
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(PhotoAlbumPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(PhotoAlbumPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoAlbumPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(PhotoAlbumPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PhotoAlbumPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    PhotoAlbumQuery The current query, for fluid interface
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
	 * Filter the query by a related Photo object
	 *
	 * @param     Photo $photo  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function filterByPhoto($photo, $comparison = null)
	{
		if ($photo instanceof Photo) {
			return $this
				->addUsingAlias(PhotoAlbumPeer::ID, $photo->getAlbumId(), $comparison);
		} elseif ($photo instanceof PropelCollection) {
			return $this
				->usePhotoQuery()
				->filterByPrimaryKeys($photo->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPhoto() only accepts arguments of type Photo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Photo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function joinPhoto($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Photo');

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
			$this->addJoinObject($join, 'Photo');
		}

		return $this;
	}

	/**
	 * Use the Photo relation Photo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoQuery A secondary query class using the current class as primary query
	 */
	public function usePhotoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPhoto($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Photo', 'PhotoQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     PhotoAlbum $photoAlbum Object to remove from the list of results
	 *
	 * @return    PhotoAlbumQuery The current query, for fluid interface
	 */
	public function prune($photoAlbum = null)
	{
		if ($photoAlbum) {
			$this->addUsingAlias(PhotoAlbumPeer::ID, $photoAlbum->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePhotoAlbumQuery