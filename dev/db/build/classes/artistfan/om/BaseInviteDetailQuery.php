<?php


/**
 * Base class that represents a query for the 'invite_detail' table.
 *
 * 
 *
 * @method     InviteDetailQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     InviteDetailQuery orderByIdApiId($order = Criteria::ASC) Order by the id_api_id column
 * @method     InviteDetailQuery orderByIdName($order = Criteria::ASC) Order by the id_name column
 * @method     InviteDetailQuery orderByIdEmail($order = Criteria::ASC) Order by the id_email column
 * @method     InviteDetailQuery orderByIdFbid($order = Criteria::ASC) Order by the id_fbid column
 * @method     InviteDetailQuery orderByCdate($order = Criteria::ASC) Order by the cdate column
 * @method     InviteDetailQuery orderByMdate($order = Criteria::ASC) Order by the mdate column
 * @method     InviteDetailQuery orderByIdTwid($order = Criteria::ASC) Order by the id_twid column
 * @method     InviteDetailQuery orderByIdImage($order = Criteria::ASC) Order by the id_image column
 *
 * @method     InviteDetailQuery groupById() Group by the id column
 * @method     InviteDetailQuery groupByIdApiId() Group by the id_api_id column
 * @method     InviteDetailQuery groupByIdName() Group by the id_name column
 * @method     InviteDetailQuery groupByIdEmail() Group by the id_email column
 * @method     InviteDetailQuery groupByIdFbid() Group by the id_fbid column
 * @method     InviteDetailQuery groupByCdate() Group by the cdate column
 * @method     InviteDetailQuery groupByMdate() Group by the mdate column
 * @method     InviteDetailQuery groupByIdTwid() Group by the id_twid column
 * @method     InviteDetailQuery groupByIdImage() Group by the id_image column
 *
 * @method     InviteDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     InviteDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     InviteDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     InviteDetail findOne(PropelPDO $con = null) Return the first InviteDetail matching the query
 * @method     InviteDetail findOneOrCreate(PropelPDO $con = null) Return the first InviteDetail matching the query, or a new InviteDetail object populated from the query conditions when no match is found
 *
 * @method     InviteDetail findOneById(int $id) Return the first InviteDetail filtered by the id column
 * @method     InviteDetail findOneByIdApiId(int $id_api_id) Return the first InviteDetail filtered by the id_api_id column
 * @method     InviteDetail findOneByIdName(string $id_name) Return the first InviteDetail filtered by the id_name column
 * @method     InviteDetail findOneByIdEmail(string $id_email) Return the first InviteDetail filtered by the id_email column
 * @method     InviteDetail findOneByIdFbid(string $id_fbid) Return the first InviteDetail filtered by the id_fbid column
 * @method     InviteDetail findOneByCdate(int $cdate) Return the first InviteDetail filtered by the cdate column
 * @method     InviteDetail findOneByMdate(int $mdate) Return the first InviteDetail filtered by the mdate column
 * @method     InviteDetail findOneByIdTwid(string $id_twid) Return the first InviteDetail filtered by the id_twid column
 * @method     InviteDetail findOneByIdImage(string $id_image) Return the first InviteDetail filtered by the id_image column
 *
 * @method     array findById(int $id) Return InviteDetail objects filtered by the id column
 * @method     array findByIdApiId(int $id_api_id) Return InviteDetail objects filtered by the id_api_id column
 * @method     array findByIdName(string $id_name) Return InviteDetail objects filtered by the id_name column
 * @method     array findByIdEmail(string $id_email) Return InviteDetail objects filtered by the id_email column
 * @method     array findByIdFbid(string $id_fbid) Return InviteDetail objects filtered by the id_fbid column
 * @method     array findByCdate(int $cdate) Return InviteDetail objects filtered by the cdate column
 * @method     array findByMdate(int $mdate) Return InviteDetail objects filtered by the mdate column
 * @method     array findByIdTwid(string $id_twid) Return InviteDetail objects filtered by the id_twid column
 * @method     array findByIdImage(string $id_image) Return InviteDetail objects filtered by the id_image column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseInviteDetailQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseInviteDetailQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'InviteDetail', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new InviteDetailQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    InviteDetailQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof InviteDetailQuery) {
			return $criteria;
		}
		$query = new InviteDetailQuery();
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
	 * @return    InviteDetail|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = InviteDetailPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(InviteDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    InviteDetail A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `ID_API_ID`, `ID_NAME`, `ID_EMAIL`, `ID_FBID`, `CDATE`, `MDATE`, `ID_TWID`, `ID_IMAGE` FROM `invite_detail` WHERE `ID` = :p0';
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
			$obj = new InviteDetail();
			$obj->hydrate($row);
			InviteDetailPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    InviteDetail|array|mixed the result, formatted by the current formatter
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
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(InviteDetailPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(InviteDetailPeer::ID, $keys, Criteria::IN);
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
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(InviteDetailPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the id_api_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIdApiId(1234); // WHERE id_api_id = 1234
	 * $query->filterByIdApiId(array(12, 34)); // WHERE id_api_id IN (12, 34)
	 * $query->filterByIdApiId(array('min' => 12)); // WHERE id_api_id > 12
	 * </code>
	 *
	 * @param     mixed $idApiId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByIdApiId($idApiId = null, $comparison = null)
	{
		if (is_array($idApiId)) {
			$useMinMax = false;
			if (isset($idApiId['min'])) {
				$this->addUsingAlias(InviteDetailPeer::ID_API_ID, $idApiId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($idApiId['max'])) {
				$this->addUsingAlias(InviteDetailPeer::ID_API_ID, $idApiId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::ID_API_ID, $idApiId, $comparison);
	}

	/**
	 * Filter the query on the id_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIdName('fooValue');   // WHERE id_name = 'fooValue'
	 * $query->filterByIdName('%fooValue%'); // WHERE id_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $idName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByIdName($idName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($idName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $idName)) {
				$idName = str_replace('*', '%', $idName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::ID_NAME, $idName, $comparison);
	}

	/**
	 * Filter the query on the id_email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIdEmail('fooValue');   // WHERE id_email = 'fooValue'
	 * $query->filterByIdEmail('%fooValue%'); // WHERE id_email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $idEmail The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByIdEmail($idEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($idEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $idEmail)) {
				$idEmail = str_replace('*', '%', $idEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::ID_EMAIL, $idEmail, $comparison);
	}

	/**
	 * Filter the query on the id_fbid column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIdFbid('fooValue');   // WHERE id_fbid = 'fooValue'
	 * $query->filterByIdFbid('%fooValue%'); // WHERE id_fbid LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $idFbid The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByIdFbid($idFbid = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($idFbid)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $idFbid)) {
				$idFbid = str_replace('*', '%', $idFbid);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::ID_FBID, $idFbid, $comparison);
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
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByCdate($cdate = null, $comparison = null)
	{
		if (is_array($cdate)) {
			$useMinMax = false;
			if (isset($cdate['min'])) {
				$this->addUsingAlias(InviteDetailPeer::CDATE, $cdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cdate['max'])) {
				$this->addUsingAlias(InviteDetailPeer::CDATE, $cdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::CDATE, $cdate, $comparison);
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
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByMdate($mdate = null, $comparison = null)
	{
		if (is_array($mdate)) {
			$useMinMax = false;
			if (isset($mdate['min'])) {
				$this->addUsingAlias(InviteDetailPeer::MDATE, $mdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($mdate['max'])) {
				$this->addUsingAlias(InviteDetailPeer::MDATE, $mdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::MDATE, $mdate, $comparison);
	}

	/**
	 * Filter the query on the id_twid column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIdTwid('fooValue');   // WHERE id_twid = 'fooValue'
	 * $query->filterByIdTwid('%fooValue%'); // WHERE id_twid LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $idTwid The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByIdTwid($idTwid = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($idTwid)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $idTwid)) {
				$idTwid = str_replace('*', '%', $idTwid);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::ID_TWID, $idTwid, $comparison);
	}

	/**
	 * Filter the query on the id_image column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIdImage('fooValue');   // WHERE id_image = 'fooValue'
	 * $query->filterByIdImage('%fooValue%'); // WHERE id_image LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $idImage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function filterByIdImage($idImage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($idImage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $idImage)) {
				$idImage = str_replace('*', '%', $idImage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InviteDetailPeer::ID_IMAGE, $idImage, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     InviteDetail $inviteDetail Object to remove from the list of results
	 *
	 * @return    InviteDetailQuery The current query, for fluid interface
	 */
	public function prune($inviteDetail = null)
	{
		if ($inviteDetail) {
			$this->addUsingAlias(InviteDetailPeer::ID, $inviteDetail->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseInviteDetailQuery