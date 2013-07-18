<?php


/**
 * Base class that represents a query for the 'user_follow' table.
 *
 * 
 *
 * @method     UserFollowQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     UserFollowQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     UserFollowQuery orderByUserIdFollow($order = Criteria::ASC) Order by the user_id_follow column
 * @method     UserFollowQuery orderByFanRating($order = Criteria::ASC) Order by the fan_rating column
 *
 * @method     UserFollowQuery groupById() Group by the id column
 * @method     UserFollowQuery groupByUserId() Group by the user_id column
 * @method     UserFollowQuery groupByUserIdFollow() Group by the user_id_follow column
 * @method     UserFollowQuery groupByFanRating() Group by the fan_rating column
 *
 * @method     UserFollowQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     UserFollowQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     UserFollowQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     UserFollowQuery leftJoinUserFromK($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFromK relation
 * @method     UserFollowQuery rightJoinUserFromK($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFromK relation
 * @method     UserFollowQuery innerJoinUserFromK($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFromK relation
 *
 * @method     UserFollowQuery leftJoinUserToK($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserToK relation
 * @method     UserFollowQuery rightJoinUserToK($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserToK relation
 * @method     UserFollowQuery innerJoinUserToK($relationAlias = null) Adds a INNER JOIN clause to the query using the UserToK relation
 *
 * @method     UserFollow findOne(PropelPDO $con = null) Return the first UserFollow matching the query
 * @method     UserFollow findOneOrCreate(PropelPDO $con = null) Return the first UserFollow matching the query, or a new UserFollow object populated from the query conditions when no match is found
 *
 * @method     UserFollow findOneById(int $id) Return the first UserFollow filtered by the id column
 * @method     UserFollow findOneByUserId(int $user_id) Return the first UserFollow filtered by the user_id column
 * @method     UserFollow findOneByUserIdFollow(int $user_id_follow) Return the first UserFollow filtered by the user_id_follow column
 * @method     UserFollow findOneByFanRating(double $fan_rating) Return the first UserFollow filtered by the fan_rating column
 *
 * @method     array findById(int $id) Return UserFollow objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return UserFollow objects filtered by the user_id column
 * @method     array findByUserIdFollow(int $user_id_follow) Return UserFollow objects filtered by the user_id_follow column
 * @method     array findByFanRating(double $fan_rating) Return UserFollow objects filtered by the fan_rating column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseUserFollowQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseUserFollowQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'UserFollow', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new UserFollowQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    UserFollowQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof UserFollowQuery) {
			return $criteria;
		}
		$query = new UserFollowQuery();
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
	 * @return    UserFollow|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = UserFollowPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(UserFollowPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    UserFollow A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `USER_ID_FOLLOW`, `FAN_RATING` FROM `user_follow` WHERE `ID` = :p0';
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
			$obj = new UserFollow();
			$obj->hydrate($row);
			UserFollowPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    UserFollow|array|mixed the result, formatted by the current formatter
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
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(UserFollowPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(UserFollowPeer::ID, $keys, Criteria::IN);
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
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserFollowPeer::ID, $id, $comparison);
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
	 * @see       filterByUserFromK()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(UserFollowPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(UserFollowPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserFollowPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the user_id_follow column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserIdFollow(1234); // WHERE user_id_follow = 1234
	 * $query->filterByUserIdFollow(array(12, 34)); // WHERE user_id_follow IN (12, 34)
	 * $query->filterByUserIdFollow(array('min' => 12)); // WHERE user_id_follow > 12
	 * </code>
	 *
	 * @see       filterByUserToK()
	 *
	 * @param     mixed $userIdFollow The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterByUserIdFollow($userIdFollow = null, $comparison = null)
	{
		if (is_array($userIdFollow)) {
			$useMinMax = false;
			if (isset($userIdFollow['min'])) {
				$this->addUsingAlias(UserFollowPeer::USER_ID_FOLLOW, $userIdFollow['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userIdFollow['max'])) {
				$this->addUsingAlias(UserFollowPeer::USER_ID_FOLLOW, $userIdFollow['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserFollowPeer::USER_ID_FOLLOW, $userIdFollow, $comparison);
	}

	/**
	 * Filter the query on the fan_rating column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFanRating(1234); // WHERE fan_rating = 1234
	 * $query->filterByFanRating(array(12, 34)); // WHERE fan_rating IN (12, 34)
	 * $query->filterByFanRating(array('min' => 12)); // WHERE fan_rating > 12
	 * </code>
	 *
	 * @param     mixed $fanRating The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterByFanRating($fanRating = null, $comparison = null)
	{
		if (is_array($fanRating)) {
			$useMinMax = false;
			if (isset($fanRating['min'])) {
				$this->addUsingAlias(UserFollowPeer::FAN_RATING, $fanRating['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fanRating['max'])) {
				$this->addUsingAlias(UserFollowPeer::FAN_RATING, $fanRating['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserFollowPeer::FAN_RATING, $fanRating, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterByUserFromK($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(UserFollowPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(UserFollowPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUserFromK() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the UserFromK relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function joinUserFromK($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserFromK');

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
			$this->addJoinObject($join, 'UserFromK');
		}

		return $this;
	}

	/**
	 * Use the UserFromK relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserFromKQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUserFromK($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserFromK', 'UserQuery');
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function filterByUserToK($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(UserFollowPeer::USER_ID_FOLLOW, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(UserFollowPeer::USER_ID_FOLLOW, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUserToK() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the UserToK relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function joinUserToK($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserToK');

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
			$this->addJoinObject($join, 'UserToK');
		}

		return $this;
	}

	/**
	 * Use the UserToK relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserToKQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUserToK($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserToK', 'UserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     UserFollow $userFollow Object to remove from the list of results
	 *
	 * @return    UserFollowQuery The current query, for fluid interface
	 */
	public function prune($userFollow = null)
	{
		if ($userFollow) {
			$this->addUsingAlias(UserFollowPeer::ID, $userFollow->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseUserFollowQuery