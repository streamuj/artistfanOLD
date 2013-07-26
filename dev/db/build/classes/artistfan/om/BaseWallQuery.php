<?php


/**
 * Base class that represents a query for the 'wall' table.
 *
 * 
 *
 * @method     WallQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     WallQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     WallQuery orderByUserIdFrom($order = Criteria::ASC) Order by the user_id_from column
 * @method     WallQuery orderByMesg($order = Criteria::ASC) Order by the mesg column
 * @method     WallQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     WallQuery groupById() Group by the id column
 * @method     WallQuery groupByUserId() Group by the user_id column
 * @method     WallQuery groupByUserIdFrom() Group by the user_id_from column
 * @method     WallQuery groupByMesg() Group by the mesg column
 * @method     WallQuery groupByPdate() Group by the pdate column
 *
 * @method     WallQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     WallQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     WallQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     WallQuery leftJoinUserToK($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserToK relation
 * @method     WallQuery rightJoinUserToK($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserToK relation
 * @method     WallQuery innerJoinUserToK($relationAlias = null) Adds a INNER JOIN clause to the query using the UserToK relation
 *
 * @method     WallQuery leftJoinUserFromK($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFromK relation
 * @method     WallQuery rightJoinUserFromK($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFromK relation
 * @method     WallQuery innerJoinUserFromK($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFromK relation
 *
 * @method     Wall findOne(PropelPDO $con = null) Return the first Wall matching the query
 * @method     Wall findOneOrCreate(PropelPDO $con = null) Return the first Wall matching the query, or a new Wall object populated from the query conditions when no match is found
 *
 * @method     Wall findOneById(int $id) Return the first Wall filtered by the id column
 * @method     Wall findOneByUserId(int $user_id) Return the first Wall filtered by the user_id column
 * @method     Wall findOneByUserIdFrom(int $user_id_from) Return the first Wall filtered by the user_id_from column
 * @method     Wall findOneByMesg(string $mesg) Return the first Wall filtered by the mesg column
 * @method     Wall findOneByPdate(int $pdate) Return the first Wall filtered by the pdate column
 *
 * @method     array findById(int $id) Return Wall objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Wall objects filtered by the user_id column
 * @method     array findByUserIdFrom(int $user_id_from) Return Wall objects filtered by the user_id_from column
 * @method     array findByMesg(string $mesg) Return Wall objects filtered by the mesg column
 * @method     array findByPdate(int $pdate) Return Wall objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseWallQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseWallQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Wall', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new WallQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    WallQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof WallQuery) {
			return $criteria;
		}
		$query = new WallQuery();
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
	 * @return    Wall|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = WallPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(WallPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Wall A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `USER_ID_FROM`, `MESG`, `PHOTO`, `VIDEO`, `PDATE`, `CDATE`, `TIMELINE`, `LINK`, `ACTION` FROM `wall` WHERE `ID` = :p0';
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
			$obj = new Wall();
			$obj->hydrate($row);
			WallPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Wall|array|mixed the result, formatted by the current formatter
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
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(WallPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(WallPeer::ID, $keys, Criteria::IN);
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
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(WallPeer::ID, $id, $comparison);
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
	 * @see       filterByUserToK()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(WallPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(WallPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(WallPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the user_id_from column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserIdFrom(1234); // WHERE user_id_from = 1234
	 * $query->filterByUserIdFrom(array(12, 34)); // WHERE user_id_from IN (12, 34)
	 * $query->filterByUserIdFrom(array('min' => 12)); // WHERE user_id_from > 12
	 * </code>
	 *
	 * @see       filterByUserFromK()
	 *
	 * @param     mixed $userIdFrom The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByUserIdFrom($userIdFrom = null, $comparison = null)
	{
		if (is_array($userIdFrom)) {
			$useMinMax = false;
			if (isset($userIdFrom['min'])) {
				$this->addUsingAlias(WallPeer::USER_ID_FROM, $userIdFrom['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userIdFrom['max'])) {
				$this->addUsingAlias(WallPeer::USER_ID_FROM, $userIdFrom['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(WallPeer::USER_ID_FROM, $userIdFrom, $comparison);
	}

	/**
	 * Filter the query on the mesg column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMesg('fooValue');   // WHERE mesg = 'fooValue'
	 * $query->filterByMesg('%fooValue%'); // WHERE mesg LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mesg The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByMesg($mesg = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mesg)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mesg)) {
				$mesg = str_replace('*', '%', $mesg);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(WallPeer::MESG, $mesg, $comparison);
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
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(WallPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(WallPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(WallPeer::PDATE, $pdate, $comparison);
	}
	
/**
	 * Filter the query on the timeline column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTimeline(1234); // WHERE timeline = 1234
	 * $query->filterByTimeline(array(12, 34)); // WHERE timeline IN (12, 34)
	 * $query->filterByTimeline(array('min' => 12)); // WHERE timeline > 12
	 * </code>
	 *
	 * @param     mixed $timeline The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByTimeline($timeline = null, $comparison = null)
	{
		if (is_array($timeline)) {
			$useMinMax = false;
			if (isset($timeline['min'])) {
				$this->addUsingAlias(WallPeer::TIMELINE, $timeline['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($timeline['max'])) {
				$this->addUsingAlias(WallPeer::TIMELINE, $timeline['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(WallPeer::TIMELINE, $timeline, $comparison);
	}
	

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByUserToK($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(WallPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(WallPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    WallQuery The current query, for fluid interface
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
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function filterByUserFromK($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(WallPeer::USER_ID_FROM, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(WallPeer::USER_ID_FROM, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    WallQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     Wall $wall Object to remove from the list of results
	 *
	 * @return    WallQuery The current query, for fluid interface
	 */
	public function prune($wall = null)
	{
		if ($wall) {
			$this->addUsingAlias(WallPeer::ID, $wall->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseWallQuery